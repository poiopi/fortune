// Threads の投稿に付ける画像を、ストックの JSON から書き出す
//   node render-still.mjs <ストックJSON>... [--only=ID,ID] [--out=フォルダ]
//   例：node render-still.mjs ../2026-10.json ../2026-11.json
//   出力：png/<ext_id>.png（1080×1350・4:5・PNG）。管理画面の「Threadsの画像をまとめて追加」で、ファイル名（ext_id）でストックに結び付く
//   本文（bodies.threads.body）から文字を取り出して still.html に流し込む。Threads 本文のないストック（note専用）は飛ばす
//   【答えを出さない】クイズの画像には問題と選択肢だけを載せる。カードの番号は「?」にする
import { mkdirSync, readFileSync, writeFileSync } from 'node:fs';
import path from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';
import { openPage } from '../video/html/cdp.mjs';

const here = path.dirname(fileURLToPath(import.meta.url));
const files = process.argv.slice(2).filter((a) => !a.startsWith('--'));
const opt = (name) => process.argv.find((a) => a.startsWith(`--${name}=`))?.split('=')[1];
const only = opt('only')?.split(',');
const outDir = path.resolve(opt('out') || path.join(here, 'png'));
if (files.length === 0) {
  console.error('使い方：node render-still.mjs <ストックJSON>... [--only=ID,ID] [--out=フォルダ]');
  process.exit(1);
}

const KIND = {
  quiz:        { label: '今日のクイズ', glyph: '問', footer: '予想はコメントで。答えはリンク先で' },
  trivia:      { label: '今日の豆知識', glyph: '知', footer: 'つづきは本文とリンク先で' },
  personality: { label: '性格診断',     glyph: '心', footer: 'あなたはどれ？ コメントで教えてください' },
  guide:       { label: 'おすすめの占い', glyph: '占', footer: 'リンクから無料でためせます' },
};
// タロットの記事へのクイズは、カードの枠（絵は描かない・番号は「?」）を出す。絵が答えになるもの（顔の表情など）があるため、絵は使わない
const TAROT = {
  fool: ['THE FOOL', '愚者'], magician: ['THE MAGICIAN', '魔術師'], 'high-priestess': ['THE HIGH PRIESTESS', '女教皇'],
  empress: ['THE EMPRESS', '女帝'], emperor: ['THE EMPEROR', '皇帝'], hierophant: ['THE HIEROPHANT', '教皇'],
  lovers: ['THE LOVERS', '恋人'], chariot: ['THE CHARIOT', '戦車'], strength: ['STRENGTH', '力'], hermit: ['THE HERMIT', '隠者'],
  wheel: ['WHEEL OF FORTUNE', '運命の輪'], justice: ['JUSTICE', '正義'], 'hanged-man': ['THE HANGED MAN', '吊るされた男'],
  death: ['DEATH', '死神'], temperance: ['TEMPERANCE', '節制'], devil: ['THE DEVIL', '悪魔'], tower: ['THE TOWER', '塔'],
  star: ['THE STAR', '星'], moon: ['THE MOON', '月'], sun: ['THE SUN', '太陽'], judgement: ['JUDGEMENT', '審判'], world: ['THE WORLD', '世界'],
};
// 画像に載せない行：リンクの行、コメントへの呼びかけ（下の footer で出す）
const isCallLine = (l) => l.includes('{link}') || /^予想はコメントで/.test(l) || /^あなたはどれ/.test(l);

/** Threads 本文 → 画像の中身 */
export function toSpec(item, seed) {
  const k = KIND[item.kind];
  if (!k) throw new Error(item.ext_id + '：種類 ' + item.kind + ' の型がありません');
  const lines = item.bodies.threads.body.split('\n').map((l) => l.trim()).filter((l) => l !== '');
  if (/^【.+】$/.test(lines[0])) lines.shift();
  const choices = [], text = [];
  for (const l of lines) {
    const m = l.match(/^([A-D])[.．]\s*(.+)$/) || l.match(/^(○)\s*(.+)$/);
    if (m) choices.push({ mark: m[1] === '○' ? '・' : m[1], text: m[2] });
    else if (!isCallLine(l)) text.push(l);
  }
  // 豆知識・サイト誘導は、最初の1〜2文だけを大きく載せる（全文は投稿の本文で読める）
  let shown = text;
  if (choices.length === 0) {
    shown = [];
    for (const l of text) {
      // 読点で終わる行（「〜では、」のように次の行に続く行）は、そこで切ると文が途切れるので載せない
      if (shown.length >= 2 || (shown.length >= 1 && shown.join('').length + l.length > 64) || /[、：:]$/.test(l)) break;
      shown.push(l);
    }
  }
  const slug = (item.link_url || '').match(/\/articles\/tarot\/([a-z-]+)\/?$/)?.[1];
  const emblem = item.kind === 'quiz' && slug && TAROT[slug]
    ? { type: 'card', name: TAROT[slug][0], nameJa: TAROT[slug][1] }
    : { type: 'seal', glyph: k.glyph };
  return { label: k.label, emblem, text: shown, choices, footer: k.footer, seed };
}

const items = files.flatMap((f) => JSON.parse(readFileSync(f, 'utf8')).items)
  .filter((i) => i.bodies?.threads?.body && (!only || only.includes(i.ext_id)));
mkdirSync(outDir, { recursive: true });

const page = await openPage(1080, 1350);
try {
  await page.load(pathToFileURL(path.join(here, 'still.html')).href);
  let n = 0;
  for (const item of items) {
    const spec = toSpec(item, 7 + n);
    await page.evaluate(`window.render(${JSON.stringify(spec)})`);
    const fit = await page.evaluate('window.FIT');
    const file = path.join(outDir, item.ext_id + '.png');
    writeFileSync(file, await page.screenshot());
    console.log(`${item.ext_id}  本文${fit.textSize}px 選択肢${fit.choiceSize}px${fit.overflow ? '  ★はみ出し' : ''}`);
    n++;
  }
  console.log(`${n}枚 → ${outDir}`);
} finally {
  await page.close();
}

// export-tarot-data.js
//
// test.life-fun.net/tarot.php の TAROT 定数（22枚の大アルカナ静的データ）を、
// 手動転記せずファイルから直接抽出し、以下2つを生成する。
//
//   1. test.life-fun.net/inc/tarot-data.php … Engine側の資産（TAROT_DATA, Engine←Data→UI）
//   2. tests/cases/tarot-golden.php         … Golden Master（22カード×正逆=44ケース）
//
// 手で22枚分のテキストを書き写すとタイポのリスクがあるため、原本から直接抽出することで
// データの忠実性を保証する。
//
// 実行方法: node tests/tools/export-tarot-data.js

'use strict';

const fs = require('fs');
const path = require('path');

const tarotPhpPath = path.join(__dirname, '..', '..', 'test.life-fun.net', 'tarot.php');
const src = fs.readFileSync(tarotPhpPath, 'utf8');

const startMarker = 'const TAROT = [';
const startIdx = src.indexOf(startMarker);
if (startIdx === -1) throw new Error('const TAROT = [ が見つかりません');
const arrayStart = startIdx + startMarker.length - 1; // '[' の位置

// 対応する閉じ ']' を波括弧の深さで探す
let depth = 0;
let endIdx = -1;
for (let i = arrayStart; i < src.length; i++) {
  if (src[i] === '[') depth++;
  else if (src[i] === ']') {
    depth--;
    if (depth === 0) { endIdx = i; break; }
  }
}
if (endIdx === -1) throw new Error('TAROT配列の終端が見つかりません');

const arrayLiteral = src.slice(arrayStart, endIdx + 1);
// eslint-disable-next-line no-eval
const TAROT = eval(arrayLiteral);

if (TAROT.length !== 22) {
  throw new Error(`期待した22枚ではなく${TAROT.length}枚抽出されました`);
}

const DECK_VERSION = 1;

// ─────────────────────────────────────────────
// PHP値変換
// ─────────────────────────────────────────────
function phpVal(v, indent) {
  const pad = '    '.repeat(indent);
  const pad1 = '    '.repeat(indent + 1);
  if (v === null || v === undefined) return 'null';
  if (typeof v === 'boolean') return v ? 'true' : 'false';
  if (typeof v === 'number') return String(v);
  if (typeof v === 'string') return "'" + v.replace(/\\/g, '\\\\').replace(/'/g, "\\'") + "'";
  if (Array.isArray(v)) {
    if (v.length === 0) return '[]';
    const items = v.map(item => pad1 + phpVal(item, indent + 1));
    return '[\n' + items.join(',\n') + ',\n' + pad + ']';
  }
  if (typeof v === 'object') {
    const keys = Object.keys(v);
    const items = keys.map(k => pad1 + "'" + k + "' => " + phpVal(v[k], indent + 1));
    return '[\n' + items.join(',\n') + ',\n' + pad + ']';
  }
  throw new Error('unsupported type: ' + typeof v);
}

// ─────────────────────────────────────────────
// 1. inc/tarot-data.php （Engine側の資産）
// ─────────────────────────────────────────────
const dataByOrder = {};
TAROT.forEach(c => {
  dataByOrder[c.order] = {
    num: c.num,
    name: c.name,
    en: c.en,
    img: c.img,
    upright: c.upright,
    reversed: c.reversed,
    upright_msg: c.upright_msg,
    reversed_msg: c.reversed_msg,
  };
});

const dataOut = "<?php\n" +
  "declare(strict_types=1);\n\n" +
  "/**\n" +
  " * inc/tarot-data.php\n" +
  " *\n" +
  " * 大アルカナ22枚の静的データ（Engine側の資産）。\n" +
  " * test.life-fun.net/tarot.php の TAROT 定数から、tests/tools/export-tarot-data.js で\n" +
  " * 直接抽出したもの（手動転記ではない。原本と一致することはGolden Masterで検証済み）。\n" +
  " *\n" +
  " * Engine ← Data → UI という依存方向にするため、この資産はEngine側（inc/）に置く。\n" +
  " * tarot.php（UI）とtarot-engine.php（Engine）の双方がこのファイルを参照してよいが、\n" +
  " * どちらか一方のためだけに存在するものではない。\n" +
  " *\n" +
  " * TAROT_DECK_VERSIONは、将来キーワード・メッセージ・画像を改訂した際に、\n" +
  " * 過去に生成されたraw（cardOrder等）がどの版のデータで解釈されたかを区別するためのもの。\n" +
  " */\n\n" +
  "const TAROT_DECK_VERSION = " + DECK_VERSION + ";\n\n" +
  "const TAROT_DATA = " + phpVal(dataByOrder, 0) + ";\n";

fs.writeFileSync(path.join(__dirname, '..', '..', 'test.life-fun.net', 'inc', 'tarot-data.php'), dataOut, 'utf8');
console.log('Wrote inc/tarot-data.php (22 cards)');

// ─────────────────────────────────────────────
// 2. tests/cases/tarot-golden.php （Golden Master: 22×2=44ケース全件）
// ─────────────────────────────────────────────
const cases = [];
for (const card of TAROT) {
  for (const isUpright of [true, false]) {
    cases.push({
      input: { deckVersion: DECK_VERSION, cardOrder: card.order, isUpright },
      expected: {
        name: card.name,
        en: card.en,
        img: card.img,
        keywords: (isUpright ? card.upright : card.reversed),
        message: isUpright ? card.upright_msg : card.reversed_msg,
      },
    });
  }
}

const goldenDoc = {
  generator: 'test.life-fun.net/tarot.php (TAROT定数)',
  generatorVersion: '2026-07-05',
  generatedAt: new Date().toISOString(),
  deckVersion: DECK_VERSION,
  caseCount: cases.length,
  cases,
};

const goldenOut = "<?php\n" +
  "// tests/cases/tarot-golden.php\n" +
  "// Golden Master: 22カード×正逆=44ケース全件（サンプリングではなく全数）。\n" +
  "// test.life-fun.net/tarot.php の TAROT 定数から直接抽出。\n" +
  "// 生成元: tests/tools/export-tarot-data.js（再実行すれば作り直せる）\n" +
  "return " + phpVal(goldenDoc, 0) + ";\n";

fs.writeFileSync(path.join(__dirname, '..', 'cases', 'tarot-golden.php'), goldenOut, 'utf8');
console.log(`Wrote ${cases.length} cases to tests/cases/tarot-golden.php`);

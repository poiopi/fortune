// export-mbti-data.js
//
// test.life-fun.net/mbti.php の静的データ定数（mbtiData）をファイルから直接抽出し、
// docs/engine-template.mdの手順（Phase 1-1: MBTIデータ抽出）に従って以下を生成する。
//
//   1. test.life-fun.net/inc/mbti-data.php … Engine側の資産
//
// この段階ではロジック（計算・raw化）には一切触れない。データ切り出しのみ。
//
// 実行方法: node tests/tools/export-mbti-data.js

'use strict';

const fs = require('fs');
const path = require('path');
const { execFileSync } = require('child_process');

const mbtiPhpPath = path.join(__dirname, '..', '..', 'test.life-fun.net', 'mbti.php');
const mbtiDataPhpPath = path.join(__dirname, '..', '..', 'test.life-fun.net', 'inc', 'mbti-data.php');
const src = fs.readFileSync(mbtiPhpPath, 'utf8');

function extractConst(name) {
  const marker = `const ${name} = {`;
  const startIdx = src.indexOf(marker);
  if (startIdx === -1) return null; // Phase 1-1で既にPHP側へ移行済みの場合はnull
  const objStart = startIdx + marker.length - 1;
  let depth = 0;
  let endIdx = -1;
  for (let i = objStart; i < src.length; i++) {
    if (src[i] === '{') depth++;
    else if (src[i] === '}') { depth--; if (depth === 0) { endIdx = i; break; } }
  }
  if (endIdx === -1) throw new Error(`${name}オブジェクトの終端が見つかりません`);
  // eslint-disable-next-line no-eval
  return eval('(' + src.slice(objStart, endIdx + 1) + ')');
}

// mbti.phpにまだ元のJSリテラルが残っていればそこから抽出する。Phase 1-1で
// 既にinc/mbti-data.php参照へ移行済みの場合は、その既存ファイル（検証済み）から
// 読み直す（既存データを保持したまま、新しい定数だけ追記できるようにするため）。
let MBTI_DATA = extractConst('mbtiData');
if (MBTI_DATA === null) {
  if (!fs.existsSync(mbtiDataPhpPath)) {
    throw new Error('mbtiDataがmbti.phpに見つからず、inc/mbti-data.phpも存在しない');
  }
  const json = execFileSync('php', ['-r', `require '${mbtiDataPhpPath.replace(/\\/g, '/')}'; echo json_encode(MBTI_DATA);`], { encoding: 'utf8' });
  MBTI_DATA = JSON.parse(json);
}

// questions[].dim をソースから直接抽出する（mbti-engine.phpのraw計算が使う。
// tests/tools/export-mbti-golden.jsと同じ抽出方法で、手動転記による食い違いを避ける）
const QUESTION_DIMS = [...src.matchAll(/dim:'([A-Z]{2})'/g)].map(m => m[1]);
if (QUESTION_DIMS.length !== 10) {
  throw new Error(`questionsは10件のはずが${QUESTION_DIMS.length}件のdimが見つかった`);
}

const keys = Object.keys(MBTI_DATA);
if (keys.length !== 16) throw new Error(`mbtiDataは16件のはずが${keys.length}件`);
keys.forEach(k => {
  const entry = MBTI_DATA[k];
  if (typeof entry.name !== 'string') throw new Error(`${k}.nameが文字列ではない`);
  if (typeof entry.desc !== 'string') throw new Error(`${k}.descが文字列ではない`);
  if (!Array.isArray(entry.famous) || entry.famous.length === 0) throw new Error(`${k}.famousが空または配列ではない`);
});

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
    const objKeys = Object.keys(v);
    const items = objKeys.map(k => pad1 + "'" + k + "' => " + phpVal(v[k], indent + 1));
    return '[\n' + items.join(',\n') + ',\n' + pad + ']';
  }
  throw new Error('unsupported type: ' + typeof v);
}

// ─────────────────────────────────────────────
// inc/mbti-data.php （Engine側の資産）
// ─────────────────────────────────────────────
const dataOut = "<?php\n" +
  "declare(strict_types=1);\n\n" +
  "/**\n" +
  " * inc/mbti-data.php\n" +
  " *\n" +
  " * MBTI16タイプの静的データ（Engine側の資産）。\n" +
  " * test.life-fun.net/mbti.php の mbtiData 定数から、tests/tools/export-mbti-data.js で\n" +
  " * 直接抽出したもの（手動転記ではない。原本と一致することはGolden Masterで検証する）。\n" +
  " *\n" +
  " * Engine ← Data → UI という依存方向にするため、この資産はEngine側（inc/）に置く。\n" +
  " * キーはMBTIタイプコード（INTJ等）。\n" +
  " *\n" +
  " * MBTI_QUESTION_DIMSは10問の判定軸（'EI'等）。mbti-engine.phpのraw計算（回答→タイプ）が使う。\n" +
  " */\n\n" +
  "const MBTI_DATA = " + phpVal(MBTI_DATA, 0) + ";\n\n" +
  "const MBTI_QUESTION_DIMS = " + phpVal(QUESTION_DIMS, 0) + ";\n";

const outPath = path.join(__dirname, '..', '..', 'test.life-fun.net', 'inc', 'mbti-data.php');
fs.writeFileSync(outPath, dataOut, 'utf8');
console.log('Wrote test.life-fun.net/inc/mbti-data.php');
console.log(`Entries: ${keys.length}`);

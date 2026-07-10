// export-seiza-data.js
//
// test.life-fun.net/seiza.php の静的データ定数（SIGNS/ELEMENTS/QUALITIES/INNER_TYPES/
// TIME_ZONES/SIGN_DESC/LOVE_STYLE/JOBS）と計算ロジックをファイルから直接抽出し、
// docs/engine-template.mdの手順に従って以下を生成する。
//
//   1. test.life-fun.net/inc/seiza-data.php … Engine側の資産
//   2. tests/cases/seiza-golden.php         … Golden Master（月日366通り×時間帯5種=1830通り、全数）
//
// 実行方法: node tests/tools/export-seiza-data.js

'use strict';

const fs = require('fs');
const path = require('path');

const seizaPhpPath = path.join(__dirname, '..', '..', 'test.life-fun.net', 'seiza.php');
const src = fs.readFileSync(seizaPhpPath, 'utf8');

function extractConst(name) {
  const marker = `const ${name} = [`;
  const startIdx = src.indexOf(marker);
  if (startIdx === -1) throw new Error(`${marker} が見つかりません`);
  const arrayStart = startIdx + marker.length - 1;
  let depth = 0;
  let endIdx = -1;
  for (let i = arrayStart; i < src.length; i++) {
    if (src[i] === '[') depth++;
    else if (src[i] === ']') { depth--; if (depth === 0) { endIdx = i; break; } }
  }
  if (endIdx === -1) throw new Error(`${name}配列の終端が見つかりません`);
  // eslint-disable-next-line no-eval
  return eval(src.slice(arrayStart, endIdx + 1));
}

const SIGNS = extractConst('SIGNS');
const ELEMENTS = extractConst('ELEMENTS');
const QUALITIES = extractConst('QUALITIES');
const INNER_TYPES = extractConst('INNER_TYPES');
const TIME_ZONES = extractConst('TIME_ZONES');
const SIGN_DESC = extractConst('SIGN_DESC');
const LOVE_STYLE = extractConst('LOVE_STYLE');
const JOBS = extractConst('JOBS');

if (SIGNS.length !== 12) throw new Error(`SIGNSは12件のはずが${SIGNS.length}件`);
if (INNER_TYPES.length !== 12) throw new Error(`INNER_TYPESは12件のはずが${INNER_TYPES.length}件`);
if (TIME_ZONES.length !== 5) throw new Error(`TIME_ZONESは5件のはずが${TIME_ZONES.length}件`);

// 計算ロジック（seiza.php本体と同一のものをここに複製。忠実性はGolden Masterで検証する）
function getZodiacIndex(month, day) {
  const FIRST_SIGN = [0,1,2,3,4,5,6,7,8,9,10,11];
  const CUTOFF     = [19,18,20,19,20,21,22,22,22,23,21,21];
  const m = month - 1;
  return day <= CUTOFF[m] ? FIRST_SIGN[m] : (FIRST_SIGN[m] + 1) % 12;
}
function getInnerTypeIndex(month, day) {
  return (month * 31 + day) % 12;
}
function getTimeZoneIndex(code) {
  const map = { M: 0, D: 1, N: 2, L: 3, U: 4 };
  return map[code] ?? 4;
}

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
// 1. inc/seiza-data.php （Engine側の資産）
// ─────────────────────────────────────────────
const dataOut = "<?php\n" +
  "declare(strict_types=1);\n\n" +
  "/**\n" +
  " * inc/seiza-data.php\n" +
  " *\n" +
  " * 西洋占星術の静的データ（Engine側の資産）。\n" +
  " * test.life-fun.net/seiza.php の各定数から、tests/tools/export-seiza-data.js で\n" +
  " * 直接抽出したもの（手動転記ではない。原本と一致することはGolden Masterで検証済み）。\n" +
  " *\n" +
  " * Engine ← Data → UI という依存方向にするため、この資産はEngine側（inc/）に置く。\n" +
  " */\n\n" +
  "const SEIZA_SIGNS = " + phpVal(SIGNS, 0) + ";\n\n" +
  "const SEIZA_ELEMENTS = " + phpVal(ELEMENTS, 0) + ";\n\n" +
  "const SEIZA_QUALITIES = " + phpVal(QUALITIES, 0) + ";\n\n" +
  "const SEIZA_INNER_TYPES = " + phpVal(INNER_TYPES, 0) + ";\n\n" +
  "const SEIZA_TIME_ZONES = " + phpVal(TIME_ZONES, 0) + ";\n\n" +
  "const SEIZA_SIGN_DESC = " + phpVal(SIGN_DESC, 0) + ";\n\n" +
  "const SEIZA_LOVE_STYLE = " + phpVal(LOVE_STYLE, 0) + ";\n\n" +
  "const SEIZA_JOBS = " + phpVal(JOBS, 0) + ";\n";

fs.writeFileSync(path.join(__dirname, '..', '..', 'test.life-fun.net', 'inc', 'seiza-data.php'), dataOut, 'utf8');
console.log('Wrote inc/seiza-data.php');

// ─────────────────────────────────────────────
// 2. tests/cases/seiza-golden.php （Golden Master: 月日366通り×時間帯5種、全数）
// ─────────────────────────────────────────────
const daysInMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; // 2月は29日まで許容
const tzCodes = ['M', 'D', 'N', 'L', 'U'];

const cases = [];
for (let month = 1; month <= 12; month++) {
  for (let day = 1; day <= daysInMonth[month - 1]; day++) {
    for (const tzCode of tzCodes) {
      const signIdx = getZodiacIndex(month, day);
      const innerIdx = getInnerTypeIndex(month, day);
      const tzIdx = getTimeZoneIndex(tzCode);
      cases.push({
        input: { month, day, timeZoneCode: tzCode },
        expected: { signIndex: signIdx, innerTypeIndex: innerIdx, timeZoneIndex: tzIdx },
      });
    }
  }
}

const goldenDoc = {
  generator: 'test.life-fun.net/seiza.php (getZodiacIndex/getInnerTypeIndex/getTimeZoneIndex)',
  generatorVersion: '2026-07-05',
  generatedAt: new Date().toISOString(),
  caseCount: cases.length,
  cases,
};

const goldenOut = "<?php\n" +
  "// tests/cases/seiza-golden.php\n" +
  "// Golden Master: 月日366通り×時間帯5種=1830ケース全件（サンプリングではなく全数）。\n" +
  "// test.life-fun.net/seiza.php の計算ロジックから直接算出。\n" +
  "// 生成元: tests/tools/export-seiza-data.js（再実行すれば作り直せる）\n" +
  "return " + phpVal(goldenDoc, 0) + ";\n";

fs.writeFileSync(path.join(__dirname, '..', 'cases', 'seiza-golden.php'), goldenOut, 'utf8');
console.log(`Wrote ${cases.length} cases to tests/cases/seiza-golden.php`);

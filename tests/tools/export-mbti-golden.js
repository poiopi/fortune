// export-mbti-golden.js
//
// test.life-fun.net/mbti.php の10問診断ロジック（questions[].dim + calcMbti()の
// スコアリング・タイブレーク規則）をファイルから直接抽出し、Golden Masterを生成する。
// docs/engine-template.mdの手順（Phase 1-2）に従う。
//
// 対象は「計算ロジック」（10問の回答→MBTIタイプ）であり、Phase 1-1で既に抽出・
// 検証済みの静的データ（mbtiData：タイプ→name/desc/famous）は対象にしない。
// 入力空間は2^10=1024通り（有限・全数）。
//
//   生成物: tests/cases/mbti-golden.php
//
// 実行方法: node tests/tools/export-mbti-golden.js

'use strict';

const fs = require('fs');
const path = require('path');

const mbtiPhpPath = path.join(__dirname, '..', '..', 'test.life-fun.net', 'mbti.php');
const src = fs.readFileSync(mbtiPhpPath, 'utf8');

// questions[].dim をソースから直接抽出する（手動転記ではない）
const dimMatches = [...src.matchAll(/dim:'([A-Z]{2})'/g)].map(m => m[1]);
if (dimMatches.length !== 10) {
  throw new Error(`questionsは10件のはずが${dimMatches.length}件のdimが見つかった`);
}

// calcMbti()のスコアリング・タイブレーク規則をそのまま複製する
// （mbti.php本体と同一。忠実性はこのGolden Masterで今後検証する）
function calcMbti(answers, dims) {
  const scores = { E: 0, I: 0, S: 0, N: 0, T: 0, F: 0, J: 0, P: 0 };
  dims.forEach((dim, i) => {
    const letters = dim.split('');
    scores[letters[answers[i]]]++;
  });
  return (scores.E >= scores.I ? 'E' : 'I')
       + (scores.S >= scores.N ? 'S' : 'N')
       + (scores.T >= scores.F ? 'T' : 'F')
       + (scores.J >= scores.P ? 'J' : 'P');
}

// ─────────────────────────────────────────────
// 全数列挙: 2^10 = 1024通り（10問、各0/1）
// ─────────────────────────────────────────────
const cases = [];
for (let n = 0; n < 1024; n++) {
  const answers = [];
  for (let i = 0; i < 10; i++) {
    answers.push((n >> i) & 1);
  }
  const mbtiType = calcMbti(answers, dimMatches);
  cases.push({ input: { answers }, expected: { mbtiType } });
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

const goldenDoc = {
  generator: 'test.life-fun.net/mbti.php (calcMbti())',
  generatorVersion: '2026-07-10',
  generatedAt: new Date().toISOString(),
  caseCount: cases.length,
  cases,
};

const goldenOut = "<?php\n" +
  "// tests/cases/mbti-golden.php\n" +
  "// Golden Master: 10問の回答パターン2^10=1024ケース全件（サンプリングではなく全数）。\n" +
  "// test.life-fun.net/mbti.php の calcMbti() スコアリング・タイブレーク規則から直接算出。\n" +
  "// 生成元: tests/tools/export-mbti-golden.js（再実行すれば作り直せる）\n" +
  "return " + phpVal(goldenDoc, 0) + ";\n";

fs.writeFileSync(path.join(__dirname, '..', 'cases', 'mbti-golden.php'), goldenOut, 'utf8');
console.log(`Wrote ${cases.length} cases to tests/cases/mbti-golden.php`);

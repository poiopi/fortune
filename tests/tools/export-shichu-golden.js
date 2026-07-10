// export-shichu-golden.js
//
// shichu-calc-snapshot.js（現行JSロジックの忠実な複製）を使い、
// 100ケース（固定20＋シード固定疑似乱数80）分の入力と期待値を計算し、
// tests/cases/shichu-golden.php へPHP配列として書き出す。
//
// 再実行可能なツール。JS側ロジックを修正した場合や、ケースを増やしたい場合は
// このスクリプトを編集して再実行すれば、Golden Masterを作り直せる。
//
// 実行方法: node tests/tools/export-shichu-golden.js

'use strict';

const fs = require('fs');
const path = require('path');
const calc = require('./shichu-calc-snapshot.js');

// ─────────────────────────────────────────────
// 固定ケース（20件）: 境界値・閏年・性別・時刻有無・年またぎ・範囲端を意図的に含める
// ─────────────────────────────────────────────
const FIXED_CASES = [
  { year: 1990, month: 1,  day: 1,  hour: null, gender: 'male',   note: '通常ケース・時刻なし' },
  { year: 1990, month: 1,  day: 5,  hour: 10,   gender: 'female', note: '小寒節入り前後' },
  { year: 1988, month: 2,  day: 3,  hour: 23,   gender: 'male',   note: '立春前日・子の刻境界(hour=23)' },
  { year: 1988, month: 2,  day: 5,  hour: 0,    gender: 'female', note: '立春後・子の刻(hour=0)' },
  { year: 2000, month: 2,  day: 29, hour: 12,   gender: 'male',   note: '閏年2/29(21世紀係数)' },
  { year: 1996, month: 2,  day: 29, hour: 6,    gender: 'female', note: '閏年2/29(20世紀係数)' },
  { year: 2024, month: 2,  day: 29, hour: 18,   gender: 'male',   note: '閏年2/29(直近)' },
  { year: 1985, month: 12, day: 31, hour: 23,   gender: 'female', note: '年末・子の刻' },
  { year: 1999, month: 12, day: 31, hour: 0,    gender: 'male',   note: '世紀またぎ前日' },
  { year: 2000, month: 1,  day: 1,  hour: 1,    gender: 'female', note: '世紀またぎ当日' },
  { year: 1975, month: 6,  day: 15, hour: null, gender: 'male',   note: '通常ケース・時刻なし' },
  { year: 1982, month: 7,  day: 20, hour: 14,   gender: 'female', note: '通常ケース' },
  { year: 1960, month: 3,  day: 5,  hour: 3,    gender: 'male',   note: '驚蟄前後' },
  { year: 2010, month: 4,  day: 4,  hour: 9,    gender: 'female', note: '清明前後' },
  { year: 1993, month: 5,  day: 5,  hour: 21,   gender: 'male',   note: '立夏前後' },
  { year: 1978, month: 8,  day: 7,  hour: 15,   gender: 'female', note: '立秋前後' },
  { year: 2005, month: 11, day: 7,  hour: 2,    gender: 'male',   note: '立冬前後' },
  { year: 1965, month: 10, day: 8,  hour: 17,   gender: 'female', note: '寒露前後' },
  { year: 1900, month: 1,  day: 1,  hour: null, gender: 'male',   note: '対応範囲下限(1900年)' },
  { year: 2099, month: 12, day: 31, hour: 23,   gender: 'female', note: '対応範囲上限(2099年)' },
];

// ─────────────────────────────────────────────
// シード固定の疑似乱数（mulberry32）。同じSEEDなら常に同じ80件を再生成できる。
// ─────────────────────────────────────────────
const SEED = 20260705;
function mulberry32(seed) {
  let a = seed;
  return function () {
    a |= 0; a = (a + 0x6D2B79F5) | 0;
    let t = Math.imul(a ^ (a >>> 15), 1 | a);
    t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t;
    return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
  };
}
const rand = mulberry32(SEED);

function daysInMonth(year, month) {
  return new Date(year, month, 0).getDate();
}

function genRandomCase(i) {
  const year = 1900 + Math.floor(rand() * 200); // 1900-2099
  const month = 1 + Math.floor(rand() * 12);
  const day = 1 + Math.floor(rand() * daysInMonth(year, month));
  const hasHour = rand() < 0.7; // 7割は時刻あり
  const hour = hasHour ? Math.floor(rand() * 24) : null;
  const gender = rand() < 0.5 ? 'male' : 'female';
  return { year, month, day, hour, gender, note: `seed生成 #${i}` };
}

// 目標は「律音除外後の採用件数が100件」。固定ケースにも律音該当があり得るため、
// 同じシード乱数ストリームから、採用数が100件に達するまで追加生成し続ける
// （生成数は実行時に変動し得るが、SEED固定により同じ結果が常に再現される）。
const TARGET_ACCEPTED = 100;

// ─────────────────────────────────────────────
// 律音（getRitchin）バグ回避チェック
// tests/known-issues/ritchin-collabels-reference-error.md により、
// 律音が成立する入力はGolden Masterから除外する方針。
// 4柱のうちいずれか2つが完全に同じ干支(stem & branch)になるケースを検出し、除外する。
// ─────────────────────────────────────────────
function hasRitchin(pillars) {
  for (let i = 0; i < pillars.length - 1; i++) {
    for (let j = i + 1; j < pillars.length; j++) {
      if (pillars[i] && pillars[j] &&
          pillars[i].stem === pillars[j].stem && pillars[i].branch === pillars[j].branch) {
        return true;
      }
    }
  }
  return false;
}

// ─────────────────────────────────────────────
// 1ケース分の計算（_calcAndRenderの計算部分のみを再現。HTML生成・
// 現在時刻依存の値(今年の流年運勢・現在大運ハイライト)は対象外）
// ─────────────────────────────────────────────
function computeCase(input) {
  const { year, month, day, hour, gender } = input;
  const hasHour = hour !== null && hour !== undefined;

  const yp = calc.getYearPillar(year, month, day);
  const mp = calc.getMonthPillar(year, month, day, yp.stem);
  const dp = calc.getDayPillar(year, month, day);
  const hp = hasHour ? calc.getHourPillar(hour, dp.stem) : null;

  const pillarsForRitchinCheck = hasHour ? [hp, dp, mp, yp] : [dp, mp, yp];
  if (hasRitchin(pillarsForRitchinCheck)) {
    return { skip: true, reason: '律音成立（既知バグのためGolden Masterから除外）' };
  }

  const allStems = hasHour ? [yp.stem, mp.stem, hp.stem] : [yp.stem, mp.stem];
  const dayStrength = calc.getDayStrength(dp.stem, mp.branch, allStems);

  const positions = hasHour
    ? [
        { label: '年干', stem: yp.stem },
        { label: '年支（蔵干）', stem: calc.ZANGGAN_MAIN[yp.branch] },
        { label: '月干', stem: mp.stem },
        { label: '月支（蔵干）', stem: calc.ZANGGAN_MAIN[mp.branch] },
        { label: '日支（蔵干）', stem: calc.ZANGGAN_MAIN[dp.branch] },
        { label: '時干', stem: hp.stem },
        { label: '時支（蔵干）', stem: calc.ZANGGAN_MAIN[hp.branch] },
      ]
    : [
        { label: '年干', stem: yp.stem },
        { label: '年支（蔵干）', stem: calc.ZANGGAN_MAIN[yp.branch] },
        { label: '月干', stem: mp.stem },
        { label: '月支（蔵干）', stem: calc.ZANGGAN_MAIN[mp.branch] },
        { label: '日支（蔵干）', stem: calc.ZANGGAN_MAIN[dp.branch] },
      ];

  const tenGodGrid = positions.map(pos => {
    const g = calc.getTenGod(dp.stem, pos.stem);
    return { label: pos.label, stem: pos.stem, tenGodIndex: g };
  }).filter(x => x.tenGodIndex >= 0);

  const dayCycle = (calc.getJDN(year, month, day) + 49) % 60;
  const tenchusatsuBranches = calc.getTenchusatsu(dayCycle);

  const dy = calc.getDaiyun(year, month, day, gender, yp.stem, mp.stem, mp.branch);
  const daiyunPeriods = dy.daiyun.map(d => ({
    stem: d.stem,
    branch: d.branch,
    startAge: d.startAge,
    tenGodIndex: calc.getTenGod(dp.stem, d.stem),
    juniName: calc.getJuniUnsei(dp.stem, d.branch),
  }));

  return {
    skip: false,
    expected: {
      yearPillar: yp,
      monthPillar: mp,
      dayPillar: dp,
      hourPillar: hp,
      dayStrength,
      tenGodGrid,
      tenchusatsuBranches,
      daiyun: { forward: dy.forward, startAge: dy.startAge, periods: daiyunPeriods },
    },
  };
}

// ─────────────────────────────────────────────
// PHP配列リテラルへ変換
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
    if (keys.length === 0) return '[]';
    const items = keys.map(k => pad1 + "'" + k + "' => " + phpVal(v[k], indent + 1));
    return '[\n' + items.join(',\n') + ',\n' + pad + ']';
  }
  throw new Error('unsupported type: ' + typeof v);
}

// ─────────────────────────────────────────────
// メイン
// ─────────────────────────────────────────────
function main() {
  const cases = [];
  const skippedCases = [];
  let randomGenerated = 0;

  function tryAdd(c) {
    const input = { year: c.year, month: c.month, day: c.day, hour: c.hour, gender: c.gender };
    const result = computeCase(input);
    if (result.skip) {
      skippedCases.push({ input: { ...input, note: c.note }, reason: result.reason });
      return;
    }
    cases.push({ input: { ...input, note: c.note }, expected: result.expected });
  }

  // 固定ケース（律音に該当する場合も除外はするが、差し替えは行わない＝境界値としての意図を優先）
  for (const c of FIXED_CASES) tryAdd(c);

  // シード乱数ケースは、採用数がTARGET_ACCEPTEDに達するまで生成し続ける
  while (cases.length < TARGET_ACCEPTED) {
    randomGenerated++;
    tryAdd(genRandomCase(randomGenerated));
  }

  const nowIso = new Date().toISOString().replace('.000Z', '+00:00');
  const doc = {
    generator: 'test.life-fun.net/shichu.php (JS)',
    generatorVersion: '2026-07-05',
    generatedAt: nowIso,
    seed: SEED,
    caseCount: cases.length,
    skippedRitchinCount: skippedCases.length,
    cases,
  };

  const out = "<?php\n" +
    "// tests/cases/shichu-golden.php\n" +
    "// Golden Master: test.life-fun.net/shichu.php のJS計算ロジックから採取した期待値。\n" +
    "// 生成元: tests/tools/export-shichu-golden.js （再実行すれば作り直せる）\n" +
    "// 律音（既知バグ、tests/known-issues/ritchin-collabels-reference-error.md）が成立するケースは\n" +
    "// このGolden Masterから除外している。除外したケース自体はtests/known-issues/ritchin-collabels-cases.php\n" +
    "// に保存しているので、バグ修正後にそちらから昇格させること。\n" +
    "return " + phpVal(doc, 0) + ";\n";

  const outPath = path.join(__dirname, '..', 'cases', 'shichu-golden.php');
  fs.writeFileSync(outPath, out, 'utf8');
  console.log(`Wrote ${cases.length} cases (skipped ${skippedCases.length} ritchin cases) to ${outPath}`);

  // 除外した律音ケースも捨てずに保存する（バグ修正後の検証・Golden Master昇格用）
  const skippedDoc = {
    generator: 'test.life-fun.net/shichu.php (JS)',
    generatorVersion: '2026-07-05',
    generatedAt: nowIso,
    seed: SEED,
    note: '律音（getRitchinのcolLabelsスコープ外参照）により現行JS版ではReferenceErrorになるケース。バグ修正後、この入力でGolden Masterを再生成すればexpectedを採取できる。',
    cases: skippedCases,
  };
  const skippedOut = "<?php\n" +
    "// tests/known-issues/ritchin-collabels-cases.php\n" +
    "// 律音バグ（tests/known-issues/ritchin-collabels-reference-error.md）により、\n" +
    "// Golden Masterから除外した入力ケース。expectedは未採取（現行JSがReferenceErrorになるため）。\n" +
    "// 生成元: tests/tools/export-shichu-golden.js\n" +
    "return " + phpVal(skippedDoc, 0) + ";\n";
  const skippedPath = path.join(__dirname, '..', 'known-issues', 'ritchin-collabels-cases.php');
  fs.writeFileSync(skippedPath, skippedOut, 'utf8');
  console.log(`Wrote ${skippedCases.length} skipped (ritchin) cases to ${skippedPath}`);
}

main();

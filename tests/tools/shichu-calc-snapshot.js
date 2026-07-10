// shichu-calc-snapshot.js
//
// !!! これは移植元（ポーティングソース）ではなく、Golden Master採取専用のスナップショットです !!!
//
//   shichu.php
//       │
//       ├── このファイル（Node Snapshot）──→ Golden Master（tests/cases/shichu-golden.php）
//       │
//       └── inc/shichu-engine.php（PHP Engine、Step1-2以降で実装）──→ Golden Masterと一致確認
//
// PHP Engine（inc/shichu-engine.php）を修正・改善する際、このファイルまで修正してはいけない。
// このファイルの役目はGolden Masterを一度作ること（および将来作り直すこと）だけであり、
// 「正解」はあくまでGolden Master（tests/cases/shichu-golden.php）そのもの。
//
// test.life-fun.net/shichu.php（2026-07-05時点）の計算ロジックを忠実に複製したスナップショット。
// DOM操作・HTML生成関数・resetForm等は含まない。
//
// 除外した関数: getRitchin()
//   理由: tests/known-issues/ritchin-collabels-reference-error.md 参照。
//   colLabelsがスコープ外参照でReferenceErrorになる既知バグがあるため、
//   Golden Master採取の対象からは切り離す（律音が成立する入力は100ケースに含めない）。
//
// 除外した値: 今年の流年運勢(nenun)・現在大運ハイライト(currentDy)
//   理由: どちらも new Date() （実行時点の現在年）に依存し、
//   生年月日等の入力だけから決まる純粋な計算ではないため、
//   Golden Masterの再現性を保てない。raw計算の対象は「生年月日から一意に定まる値」に限定する。

'use strict';

// ═══════════════════════════════════════════════════
// 基本定数（shichu.php と同一）
// ═══════════════════════════════════════════════════
const STEMS    = ['甲','乙','丙','丁','戊','己','庚','辛','壬','癸'];
const BRANCHES = ['子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥'];
const ELEMENTS = ['木','火','土','金','水'];
const STEM_ELEM = [0,0,1,1,2,2,3,3,4,4];
const STEM_YIN  = [0,1,0,1,0,1,0,1,0,1];
const BRANCH_ELEM = [4,2,0,0,2,1,1,2,3,3,2,4];

const ZANGGAN_MAIN = [8,5,0,1,4,2,3,5,6,7,4,8];

// ═══════════════════════════════════════════════════
// 節入り日算出
// ═══════════════════════════════════════════════════
function getSolarTermDay(year, month) {
  const C20 = [6.3811,4.6295,6.3826,5.5820,6.3180,6.5000,7.9280,7.9922,8.2587,8.4328,7.3306,7.9584];
  const C21 = [5.4055,3.8708,6.3780,4.8120,5.5200,5.6780,7.1080,7.5008,7.6460,7.9000,6.9000,7.1800];
  const idx = month - 1;
  if (year >= 2000) {
    const Y = year - 2000;
    return Math.floor(C21[idx] + 0.2422 * Y) - Math.floor(Y / 4);
  } else {
    const Y = year - 1900;
    return Math.floor(C20[idx] + 0.2422 * Y) - Math.floor((Y - 1) / 4);
  }
}

// ═══════════════════════════════════════════════════
// 年柱
// ═══════════════════════════════════════════════════
function getYearPillar(year, month, day) {
  let y = year;
  const chunDay = getSolarTermDay(year, 2);
  if (month < 2 || (month === 2 && day < chunDay)) y--;
  return { stem: (y - 4 + 600) % 10, branch: (y - 4 + 600) % 12 };
}

// ═══════════════════════════════════════════════════
// 月柱
// ═══════════════════════════════════════════════════
const MONTH_BRANCH = [1,2,3,4,5,6,7,8,9,10,11,0];
function getMonthPillar(year, month, day, yearStem) {
  const termDay = getSolarTermDay(year, month);
  let m = month;
  let y = year;
  if (day < termDay) {
    m--;
    if (m === 0) { m = 12; y--; }
  }
  const branch = MONTH_BRANCH[m - 1];
  const monthStartStems = [2, 4, 6, 8, 0];
  const yStem = (y - 4 + 600) % 10;
  const monthOffset = (branch - 2 + 12) % 12;
  const stem = (monthStartStems[yStem % 5] + monthOffset) % 10;
  return { stem, branch };
}

// ═══════════════════════════════════════════════════
// 日柱
// ═══════════════════════════════════════════════════
function getJDN(year, month, day) {
  const a = Math.floor((14 - month) / 12);
  const y = year + 4800 - a;
  const m = month + 12 * a - 3;
  return day + Math.floor((153 * m + 2) / 5) + 365 * y +
    Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) - 32045;
}
function getDayPillar(year, month, day) {
  const jdn = getJDN(year, month, day);
  const cycle = (jdn + 49) % 60;
  return { stem: cycle % 10, branch: cycle % 12 };
}

// ═══════════════════════════════════════════════════
// 時柱
// ═══════════════════════════════════════════════════
function getHourBranch(hour) {
  if (hour === 23) return 0;
  return Math.floor((hour + 1) / 2);
}
function getHourPillar(hour, dayStem) {
  const branch = getHourBranch(hour);
  const startStems = [0, 2, 4, 6, 8];
  const stem = (startStems[dayStem % 5] + branch) % 10;
  return { stem, branch };
}

// ═══════════════════════════════════════════════════
// 十神（通変星）
// ═══════════════════════════════════════════════════
const JUSSHIN_NAMES = ['比肩','劫財','食神','傷官','偏財','正財','偏官','正官','偏印','印綬'];
function getTenGod(dayStem, otherStem) {
  if (dayStem === otherStem) return 0;
  const de = STEM_ELEM[dayStem], dy = STEM_YIN[dayStem];
  const oe = STEM_ELEM[otherStem], oy = STEM_YIN[otherStem];
  const same = dy === oy;
  if (de === oe) return same ? 0 : 1;
  if ((de + 1) % 5 === oe) return same ? 2 : 3;
  if ((de + 2) % 5 === oe) return same ? 4 : 5;
  if ((de + 3) % 5 === oe) return same ? 6 : 7;
  if ((de + 4) % 5 === oe) return same ? 8 : 9;
  return -1;
}

// ═══════════════════════════════════════════════════
// 日主の強弱
// ═══════════════════════════════════════════════════
function getDayStrength(dayStem, monthBranch, allStems) {
  const de = STEM_ELEM[dayStem];
  const seasonScores = [
    [2, 1, 4, 4, 2, 1, 1, 1, 0, 0, 1, 3],
    [0, 0, 2, 2, 1, 4, 4, 2, 0, 0, 1, 1],
    [1, 3, 0, 0, 3, 2, 3, 3, 2, 2, 3, 1],
    [2, 2, 0, 0, 1, 0, 0, 1, 4, 4, 2, 2],
    [4, 3, 1, 1, 2, 0, 0, 0, 2, 2, 2, 4],
  ];
  let score = seasonScores[de][monthBranch];
  for (const s of allStems) {
    const g = getTenGod(dayStem, s);
    if (g === 0 || g === 1 || g === 8 || g === 9) score += 1;
    else score -= 0.5;
  }
  if (score >= 6) return { label:'身強', cls:'strength-strong' };
  if (score >= 3) return { label:'中和', cls:'strength-mid' };
  return { label:'身弱', cls:'strength-weak' };
}

// ═══════════════════════════════════════════════════
// 十二運星
// ═══════════════════════════════════════════════════
const JUNI_UNSEI = ['長生','沐浴','冠帯','建禄','帝旺','衰','病','死','墓','絶','胎','養'];
const CHOSEISTART = [11, 6, 2, 9, 2, 9, 5, 0, 8, 3];
function getJuniUnsei(dayStem, branch) {
  const start = CHOSEISTART[dayStem];
  const yang = STEM_YIN[dayStem] === 0;
  const steps = yang ? (branch - start + 12) % 12 : (start - branch + 12) % 12;
  return JUNI_UNSEI[steps];
}

// ═══════════════════════════════════════════════════
// 天中殺
// ═══════════════════════════════════════════════════
function getTenchusatsu(dayCycle) {
  const missing = [[10,11],[8,9],[6,7],[4,5],[2,3],[0,1]];
  return missing[Math.floor(dayCycle / 10)];
}

// ═══════════════════════════════════════════════════
// 大運算出
// ═══════════════════════════════════════════════════
function getDaiyun(birthYear, birthMonth, birthDay, gender, yearStem, monthStem, monthBranch) {
  const yearYang = yearStem % 2 === 0;
  const forward = (gender === 'male' && yearYang) || (gender === 'female' && !yearYang);

  let days = 0;
  if (forward) {
    let m = birthMonth, y = birthYear;
    const termDay = getSolarTermDay(y, m);
    if (birthDay >= termDay) { m++; if (m > 12) { m = 1; y++; } }
    const nextTerm = new Date(y, m - 1, getSolarTermDay(y, m));
    const birth = new Date(birthYear, birthMonth - 1, birthDay);
    days = Math.round((nextTerm - birth) / 86400000);
  } else {
    let m = birthMonth, y = birthYear;
    const termDay = getSolarTermDay(y, m);
    let prevTermDate;
    if (birthDay < termDay) {
      m--; if (m === 0) { m = 12; y--; }
      prevTermDate = new Date(y, m - 1, getSolarTermDay(y, m));
    } else {
      prevTermDate = new Date(y, m - 1, termDay);
    }
    const birth = new Date(birthYear, birthMonth - 1, birthDay);
    days = Math.round((birth - prevTermDate) / 86400000);
  }
  const startAge = Math.round(days / 3);

  const daiyun = [];
  let s = monthStem, b = monthBranch;
  for (let i = 0; i < 8; i++) {
    if (forward) { s = (s + 1) % 10; b = (b + 1) % 12; }
    else          { s = (s + 9) % 10; b = (b + 11) % 12; }
    daiyun.push({ stem: s, branch: b, startAge: startAge + i * 10 });
  }
  return { forward, startAge, daiyun };
}

module.exports = {
  STEMS, BRANCHES, ELEMENTS, STEM_ELEM, STEM_YIN, BRANCH_ELEM, ZANGGAN_MAIN,
  JUSSHIN_NAMES, JUNI_UNSEI,
  getSolarTermDay, getYearPillar, getMonthPillar, getJDN, getDayPillar,
  getHourBranch, getHourPillar, getTenGod, getDayStrength, getJuniUnsei,
  getTenchusatsu, getDaiyun,
};

/* en/assets/try.js — practice omikuji (/en/omikuji/try/ only).
   One draw a day by the viewer's local date. Stored in localStorage "enOmikuji.v1" = {date, rank, no, tones}.
   Data comes from <script id="en-try-data" type="application/json"> (en/_inc/data.php). */
(function () {
  'use strict';

  var dataEl = document.getElementById('en-try-data');
  if (!dataEl) return;
  var D;
  try { D = JSON.parse(dataEl.textContent); } catch (e) { return; }

  var KEY = 'enOmikuji.v1';
  var TONES = ['good', 'mixed', 'careful'];
  var TOPIC_ORDER = Object.keys(D.lines);
  var RANKS = {};
  D.ranks.forEach(function (r) { RANKS[r.slug] = r; });

  var $ = function (id) { return document.getElementById(id); };
  var drawStart = $('draw-start'), drawBtn = $('draw-btn'), slipEl = $('slip'), afterEl = $('after');
  var afterNote = $('after-note'), saveBtn = $('save-btn'), shareBtn = $('share-btn'), shareMsg = $('share-msg');
  if (!drawStart || !drawBtn || !slipEl || !afterEl) return;

  var track = function (name, params) { if (typeof window.enTrack === 'function') window.enTrack(name, params); };
  var NO_STORAGE_NOTE = "Your browser isn't saving data, so this slip won't be remembered.";

  // ---- storage (all access in try/catch; drawing still works without it) ----
  var storageOk = (function () {
    try {
      var k = KEY + '.test';
      window.localStorage.setItem(k, '1');
      window.localStorage.removeItem(k);
      return true;
    } catch (e) { return false; }
  })();
  function load() {
    if (!storageOk) return null;
    try {
      var s = JSON.parse(window.localStorage.getItem(KEY) || 'null');
      if (!s || typeof s !== 'object' || !RANKS[s.rank]) return null;
      if (typeof s.no !== 'number' || s.no < 1 || s.no > 100) return null;
      if (!Array.isArray(s.tones) || s.tones.length !== TOPIC_ORDER.length) return null;
      for (var i = 0; i < s.tones.length; i++) if (TONES.indexOf(s.tones[i]) < 0) return null;
      return s;
    } catch (e) { return null; }
  }
  function save(s) {
    if (!storageOk) return false;
    try { window.localStorage.setItem(KEY, JSON.stringify(s)); return true; } catch (e) { return false; }
  }

  // ---- helpers ----
  function pad(n) { return (n < 10 ? '0' : '') + n; }
  function today() {
    var d = new Date();
    return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
  }
  function rand() {
    if (window.crypto && window.crypto.getRandomValues) {
      return window.crypto.getRandomValues(new Uint32Array(1))[0] / 4294967296;
    }
    return Math.random();
  }
  // keys: array of names, weights: array of numbers
  function pick(keys, weights) {
    var total = 0, i;
    for (i = 0; i < weights.length; i++) total += weights[i];
    var x = rand() * total;
    for (i = 0; i < keys.length; i++) {
      if (x < weights[i]) return keys[i];
      x -= weights[i];
    }
    return keys[keys.length - 1];
  }
  // 1..100 -> 一 … 九, 十, 二十三, 百
  function kanjiNum(n) {
    var S = D.slip;
    if (n >= 100) return S.hundred;
    var t = Math.floor(n / 10), o = n % 10, s = '';
    if (t > 0) s += (t > 1 ? S.digits[t] : '') + S.ten;
    if (o > 0) s += S.digits[o];
    return s;
  }
  function el(tag, attrs, text) {
    var e = document.createElement(tag);
    if (attrs) for (var k in attrs) if (Object.prototype.hasOwnProperty.call(attrs, k)) e.setAttribute(k, attrs[k]);
    if (text != null) e.textContent = text;
    return e;
  }
  function slipLines(s) {
    return TOPIC_ORDER.map(function (topic, i) {
      var tone = s.tones[i];
      var pair = D.lines[topic][tone];
      return {
        topic: topic, topicR: (D.topicRomaji && D.topicRomaji[topic]) || '',
        ja: pair[0], r: (D.lineRomaji && D.lineRomaji[pair[0]]) || '',
        en: (D.topics[topic] || topic) + ': ' + pair[1]
      };
    });
  }
  // Overall reading (総評): one of two per level, chosen by slip number so a stored draw always shows the same one.
  function summary(s) {
    var list = D.summary && D.summary[s.rank];
    return list && list.length ? list[s.no % list.length] : null;
  }

  // ---- render ----
  function render(s, animate) {
    var r = RANKS[s.rank];
    var paper = el('div', { 'class': 'slip-paper' });
    paper.appendChild(el('div', { 'class': 'slip-title', lang: 'ja' }, D.slip.title));

    var no = el('div', { 'class': 'slip-no' });
    no.appendChild(el('span', { lang: 'ja' }, D.slip.dai + kanjiNum(s.no) + D.slip.ban));
    no.appendChild(el('span', { 'class': 'en' }, 'No. ' + s.no));
    paper.appendChild(no);

    var rank = el('h2', { 'class': 'slip-rank', id: 'slip-rank', tabindex: '-1' });
    rank.appendChild(el('span', { 'class': 'k', lang: 'ja' }, r.ja));
    rank.appendChild(el('span', { 'class': 'r' }, r.romaji));
    rank.appendChild(el('span', { 'class': 'en' }, r.en));
    paper.appendChild(rank);

    paper.appendChild(el('p', { 'class': 'slip-note' }, D.note[s.rank]));

    var poem = el('div', { 'class': 'slip-poem' });
    poem.appendChild(el('span', null, 'A poem goes here on a real slip'));
    paper.appendChild(poem);

    var sum = summary(s);
    if (sum) {
      var sumEl = el('div', { 'class': 'slip-sum' });
      sumEl.appendChild(el('p', { lang: 'ja' }, sum.ja));
      sumEl.appendChild(el('p', { 'class': 'r' }, sum.romaji));
      sumEl.appendChild(el('p', { 'class': 'en' }, sum.en));
      paper.appendChild(sumEl);
    }

    var dl = el('dl', { 'class': 'slip-lines' });
    slipLines(s).forEach(function (l) {
      var row = el('div');
      var dt = el('dt');
      dt.appendChild(el('span', { lang: 'ja' }, l.topic));
      if (l.topicR) dt.appendChild(el('span', { 'class': 'r' }, l.topicR));
      row.appendChild(dt);
      var dd = el('dd');
      dd.appendChild(el('span', { lang: 'ja' }, l.ja));
      if (l.r) dd.appendChild(el('span', { 'class': 'r' }, l.r));
      dd.appendChild(el('span', { 'class': 'en' }, l.en));
      row.appendChild(dd);
      dl.appendChild(row);
    });
    paper.appendChild(dl);
    paper.appendChild(el('div', { 'class': 'slip-foot' }, 'Practice slip · life-fun.net · not issued by any shrine or temple'));

    slipEl.textContent = '';
    slipEl.appendChild(paper);
    slipEl.classList.toggle('is-revealing', !!animate);
    slipEl.hidden = false;
    drawStart.hidden = true;
    afterEl.hidden = false;
    if (!storageOk && afterNote) afterNote.textContent = NO_STORAGE_NOTE;
  }

  var current = load();
  if (current && current.date !== today()) current = null;
  if (current) render(current, false);
  else drawStart.hidden = false;

  drawBtn.addEventListener('click', function () {
    var keys = D.ranks.map(function (r) { return r.slug; });
    var rank = pick(keys, keys.map(function (k) { return Number(D.weights[k]) || 0; }));
    var tw = D.tone[rank];
    var s = {
      date: today(),
      rank: rank,
      no: Math.floor(rand() * 100) + 1,
      tones: TOPIC_ORDER.map(function () { return pick(TONES, tw); })
    };
    if (!save(s)) storageOk = false;
    current = s;
    render(s, true);
    track('en_omikuji_draw', { rank: rank });
    var h = $('slip-rank');
    if (h) h.focus();
  });

  // ---- save as image (canvas, made in the browser, never uploaded) ----
  var C = { paper: '#f7f3ea', card: '#fbf9f4', ink: '#2b2a27', muted: '#6f6a60', line: '#e0d9ca', shu: '#b4432e' };
  var FF_JA = '"Noto Serif JP", serif', FF_BODY = 'Inter, system-ui, sans-serif', FF_HEAD = '"Source Serif 4", Georgia, serif';

  function fontsReady(s) {
    if (!document.fonts || !document.fonts.load) return Promise.resolve();
    var ja = D.slip.title + D.slip.dai + D.slip.ban + kanjiNum(s.no) + RANKS[s.rank].ja +
      slipLines(s).map(function (l) { return l.topic + l.ja; }).join('') + ((summary(s) || {}).ja || '');
    var loads = [
      document.fonts.load('700 40px ' + FF_JA, ja),
      document.fonts.load('500 40px ' + FF_JA, ja),
      document.fonts.load('italic 400 30px ' + FF_HEAD, 'aō'),
      document.fonts.load('400 20px ' + FF_BODY, 'a'),
      document.fonts.load('600 20px ' + FF_BODY, 'a')
    ].map(function (p) { return p.catch(function () {}); });
    return Promise.all(loads).then(function () { return document.fonts.ready; }).catch(function () {});
  }
  function fit(ctx, text, font, size, maxW) {
    var px = size;
    ctx.font = font.replace('{px}', px + 'px');
    while (px > 10 && ctx.measureText(text).width > maxW) {
      px -= 1;
      ctx.font = font.replace('{px}', px + 'px');
    }
  }
  function wrap(ctx, text, maxW) {
    var words = text.split(' '), lines = [], line = '';
    words.forEach(function (w) {
      var test = line ? line + ' ' + w : w;
      if (line && ctx.measureText(test).width > maxW) { lines.push(line); line = w; } else line = test;
    });
    if (line) lines.push(line);
    return lines;
  }
  // Japanese has no spaces: break after 、。 where possible, and by character only inside a phrase that is too long.
  function wrapJa(ctx, text, maxW) {
    var lines = [], line = '';
    (text.match(/[^、。]+[、。]?/g) || [text]).forEach(function (seg) {
      if (ctx.measureText(line + seg).width <= maxW) { line += seg; return; }
      if (line) { lines.push(line); line = ''; }
      Array.from(seg).forEach(function (ch) {
        if (line && ctx.measureText(line + ch).width > maxW) { lines.push(line); line = ch; } else line += ch;
      });
    });
    if (line) lines.push(line);
    return lines;
  }
  var ROW_H = 84;
  // Lays out the overall reading; returns its lines and height so the canvas can be sized first.
  function sumLayout(ctx, sum, maxW) {
    if (!sum) return null;
    ctx.font = '500 30px ' + FF_JA; var ja = wrapJa(ctx, sum.ja, maxW);
    ctx.font = 'italic 400 22px ' + FF_HEAD; var ro = wrap(ctx, sum.romaji, maxW);
    ctx.font = '400 22px ' + FF_BODY; var en = wrap(ctx, sum.en, maxW);
    return { ja: ja, ro: ro, en: en, h: ja.length * 44 + 12 + ro.length * 30 + 10 + en.length * 30 + 28 };
  }
  function drawCanvas(s) {
    var W = 1080, r = RANKS[s.rank];
    var x0 = 140, x1 = 940, cw = x1 - x0, cx = W / 2;
    var probe = document.createElement('canvas').getContext('2d');
    probe.font = '400 22px ' + FF_BODY;
    var noteLines = wrap(probe, D.note[s.rank], cw - 140);
    var sumL = sumLayout(probe, summary(s), cw - 140);
    var linesTop = 570 + noteLines.length * 32 + 8 + 84 + (sumL ? sumL.h : 0);
    var H = linesTop + TOPIC_ORDER.length * ROW_H + 160;

    var cv = document.createElement('canvas');
    cv.width = W; cv.height = H;
    var ctx = cv.getContext('2d');

    ctx.fillStyle = C.paper; ctx.fillRect(0, 0, W, H);
    ctx.fillStyle = C.card; ctx.fillRect(x0, 60, cw, H - 120);
    ctx.strokeStyle = C.line; ctx.lineWidth = 2; ctx.strokeRect(x0, 60, cw, H - 120);
    ctx.fillStyle = C.shu; ctx.fillRect(x0, 60, cw, 8);

    ctx.textAlign = 'center'; ctx.textBaseline = 'alphabetic';
    ctx.fillStyle = C.muted; ctx.font = '500 34px ' + FF_JA;
    ctx.fillText(D.slip.title, cx, 145);

    ctx.fillStyle = C.ink; ctx.font = '500 30px ' + FF_JA;
    var noJa = D.slip.dai + kanjiNum(s.no) + D.slip.ban;
    ctx.fillText(noJa, cx, 205);
    ctx.fillStyle = C.muted; ctx.font = '400 22px ' + FF_BODY;
    ctx.fillText('No. ' + s.no, cx, 240);

    ctx.fillStyle = s.rank === 'daikichi' ? C.shu : C.ink;
    fit(ctx, r.ja, '700 {px} ' + FF_JA, 150, cw - 120);
    ctx.fillText(r.ja, cx, 420);
    ctx.fillStyle = C.muted; ctx.font = 'italic 400 34px ' + FF_HEAD;
    ctx.fillText(r.romaji, cx, 475);
    ctx.fillStyle = C.ink; ctx.font = '500 28px ' + FF_BODY;
    ctx.fillText(r.en, cx, 518);

    var y = 570;
    ctx.fillStyle = '#4a463f'; ctx.font = '400 22px ' + FF_BODY;
    noteLines.forEach(function (line) { ctx.fillText(line, cx, y); y += 32; });

    y += 8;
    ctx.save();
    ctx.setLineDash([8, 6]); ctx.strokeStyle = '#cfc6b3'; ctx.lineWidth = 2;
    ctx.strokeRect(x0 + 60, y, cw - 120, 56);
    ctx.restore();
    ctx.fillStyle = C.muted; ctx.font = '400 18px ' + FF_BODY;
    ctx.fillText('A poem goes here on a real slip', cx, y + 35);
    y += 84;

    if (sumL) {
      var sy = y + 34;
      ctx.fillStyle = C.ink; ctx.font = '500 30px ' + FF_JA;
      sumL.ja.forEach(function (line) { ctx.fillText(line, cx, sy); sy += 44; });
      sy += 12 - 44 + 30;
      ctx.fillStyle = C.muted; ctx.font = 'italic 400 22px ' + FF_HEAD;
      sumL.ro.forEach(function (line) { ctx.fillText(line, cx, sy); sy += 30; });
      sy += 10;
      ctx.fillStyle = '#4a463f'; ctx.font = '400 22px ' + FF_BODY;
      sumL.en.forEach(function (line) { ctx.fillText(line, cx, sy); sy += 30; });
      y += sumL.h;
    }

    ctx.textAlign = 'left';
    var rowH = ROW_H, tx = x0 + 60, px = x0 + 200, maxW = x1 - 60 - px;
    slipLines(s).forEach(function (l, i) {
      var top = y + i * rowH;
      ctx.strokeStyle = C.line; ctx.lineWidth = 1;
      ctx.beginPath(); ctx.moveTo(x0 + 60, top); ctx.lineTo(x1 - 60, top); ctx.stroke();
      ctx.fillStyle = C.ink; ctx.font = '700 28px ' + FF_JA;
      ctx.fillText(l.topic, tx, top + 40);
      if (l.topicR) {
        ctx.fillStyle = C.muted; ctx.font = 'italic 400 17px ' + FF_HEAD;
        ctx.fillText(l.topicR, tx, top + 64);
      }
      ctx.fillStyle = C.ink; ctx.font = '500 24px ' + FF_JA;
      ctx.fillText(l.ja, px, top + 32);
      ctx.fillStyle = C.muted;
      if (l.r) {
        ctx.font = 'italic 400 18px ' + FF_HEAD;
        ctx.fillText(l.r, px, top + 54);
      }
      fit(ctx, l.en, '400 {px} ' + FF_BODY, 18, maxW);
      ctx.fillText(l.en, px, top + 76);
    });
    var end = y + TOPIC_ORDER.length * rowH;
    ctx.strokeStyle = C.line; ctx.beginPath(); ctx.moveTo(x0 + 60, end); ctx.lineTo(x1 - 60, end); ctx.stroke();

    ctx.textAlign = 'center'; ctx.fillStyle = C.muted;
    var foot = 'Practice slip · life-fun.net/en/omikuji/try/ · not issued by any shrine or temple';
    fit(ctx, foot, '400 {px} ' + FF_BODY, 18, cw - 60);
    ctx.fillText(foot, cx, H - 100);
    return cv;
  }
  function download(blobOrUrl, name, isUrl) {
    var a = document.createElement('a');
    var url = isUrl ? blobOrUrl : URL.createObjectURL(blobOrUrl);
    a.href = url; a.download = name;
    document.body.appendChild(a); a.click(); document.body.removeChild(a);
    if (!isUrl) setTimeout(function () { URL.revokeObjectURL(url); }, 4000);
  }
  if (saveBtn) saveBtn.addEventListener('click', function () {
    if (!current) return;
    var s = current, name = 'omikuji-practice-' + s.date + '.png';
    fontsReady(s).then(function () {
      var cv = drawCanvas(s);
      if (cv.toBlob) cv.toBlob(function (b) { if (b) download(b, name, false); }, 'image/png');
      else download(cv.toDataURL('image/png'), name, true);
      track('en_share', { method: 'save_image', rank: s.rank });
    });
  });

  // ---- share link ----
  function setMsg(t) { if (shareMsg) shareMsg.textContent = t; }
  function copyLink(url, rank) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(url).then(function () {
        setMsg('Link copied.');
        track('en_share', { method: 'copy_link', rank: rank });
      }, function () { setMsg(url); });
    } else {
      setMsg(url);
    }
  }
  if (shareBtn) shareBtn.addEventListener('click', function () {
    if (!current) return;
    var rank = current.rank;
    var url = location.origin + '/en/omikuji/try/?r=' + encodeURIComponent(rank);
    if (navigator.share) {
      navigator.share({ title: document.title, url: url }).then(function () {
        track('en_share', { method: 'share', rank: rank });
      }, function (err) {
        if (err && err.name === 'AbortError') return;
        copyLink(url, rank);
      });
    } else {
      copyLink(url, rank);
    }
  });
})();

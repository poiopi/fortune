// 手元の Chrome をヘッドレスで開いて操作する部品（Chrome DevTools Protocol。Node 22 以上の WebSocket を使い、npm パッケージ不要）
//   動画（render.mjs）と Threads の画像（../../threads-image/render-still.mjs）が使う
import { spawn } from 'node:child_process';
import { mkdtempSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import path from 'node:path';

const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

/** Chrome を開き、指定の大きさのページを1枚用意する。使い終わったら close() */
export async function openPage(width, height) {
  const chrome = process.env.CHROME || 'C:/Program Files/Google/Chrome/Application/chrome.exe';
  const port = 9300 + Math.floor(Math.random() * 600);
  const profile = mkdtempSync(path.join(tmpdir(), 'cdp-render-'));
  const browser = spawn(chrome, ['--headless=new', `--remote-debugging-port=${port}`, `--user-data-dir=${profile}`,
    '--hide-scrollbars', '--mute-audio', '--allow-file-access-from-files', `--window-size=${width},${height}`, 'about:blank'], { stdio: 'ignore' });

  let ws, seq = 0;
  const pending = new Map();
  const send = (method, params = {}) => new Promise((resolve, reject) => {
    const msgId = ++seq;
    pending.set(msgId, { resolve, reject, method });
    ws.send(JSON.stringify({ id: msgId, method, params }));
  });
  const evaluate = async (expression) => {
    const r = await send('Runtime.evaluate', { expression, returnByValue: true, awaitPromise: true });
    if (r.exceptionDetails) throw new Error('ページのエラー：' + JSON.stringify(r.exceptionDetails).slice(0, 400));
    return r.result.value;
  };
  const close = async () => {
    try { ws?.close(); } catch { /* 終了処理 */ }
    browser.kill();
    await sleep(500);
    try { rmSync(profile, { recursive: true, force: true }); } catch { /* Chrome がまだ掴んでいることがある */ }
  };

  try {
    let target;
    for (let i = 0; i < 100 && !target; i++) {
      await sleep(150);
      try {
        const list = await (await fetch(`http://127.0.0.1:${port}/json/list`)).json();
        target = list.find((t) => t.type === 'page');
      } catch { /* 起動待ち */ }
    }
    if (!target) throw new Error('Chrome に接続できませんでした');
    ws = new WebSocket(target.webSocketDebuggerUrl);
    await new Promise((r, j) => { ws.onopen = r; ws.onerror = j; });
    ws.onmessage = (ev) => {
      const m = JSON.parse(ev.data);
      if (!m.id || !pending.has(m.id)) return;
      const p = pending.get(m.id); pending.delete(m.id);
      m.error ? p.reject(new Error(p.method + ': ' + m.error.message)) : p.resolve(m.result);
    };
    await send('Emulation.setDeviceMetricsOverride', { width, height, deviceScaleFactor: 1, mobile: false });
    await send('Page.enable');
  } catch (e) {
    await close();
    throw e;
  }

  return {
    send, evaluate, close,
    /** ページを開き、window.READY が true になるまで待つ */
    async load(url, timeoutMs = 20000) {
      await send('Page.navigate', { url });
      for (let waited = 0; waited < timeoutMs; waited += 100) {
        await sleep(100);
        if (await evaluate('window.READY === true').catch(() => false)) return;
      }
      throw new Error('ページの準備（フォント・画像の読み込み）が' + timeoutMs / 1000 + '秒で終わりませんでした');
    },
    async screenshot() {
      await evaluate('new Promise((r) => requestAnimationFrame(() => r(true)))');
      const { data } = await send('Page.captureScreenshot', { format: 'png' });
      return Buffer.from(data, 'base64');
    },
  };
}

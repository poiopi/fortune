// 動画を撮る：node render.mjs <テンプレート> <ストックID> [出力.mp4] [--frames=秒,秒,...]
//   例：node render.mjs quiz 2026-11-quiz-001
//   手元の Chrome をヘッドレスで開き（cdp.mjs）、seek(t) を1コマずつ呼んで撮影 → ffmpeg で MP4 にする
//   出力は Threads の動画仕様（ADMIN_IMPL_PLAN.md 18-1）に合わせる：H.264 High・yuv420p・30fps・edit list なし・moov を先頭・AAC 48kHz ステレオ
//   --frames を付けると動画は作らず、指定した秒のコマを PNG で書き出す（確認用）
//   2026-10-29：Threads は静止画に決定。この動画の型は YouTube ショート用にとってある（YOUTUBE_SHORTS_PLAN.md）
import { spawn } from 'node:child_process';
import { writeFileSync } from 'node:fs';
import path from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';
import { openPage } from './cdp.mjs';

const args = process.argv.slice(2).filter((a) => !a.startsWith('--'));
const framesOpt = process.argv.find((a) => a.startsWith('--frames='));
const [tpl, id, outArg] = args;
if (!tpl || !id) {
  console.error('使い方：node render.mjs <テンプレート> <ストックID> [出力.mp4] [--frames=秒,秒,...]');
  process.exit(1);
}
const W = 1080, H = 1920, FPS = 30;
const here = path.dirname(fileURLToPath(import.meta.url));
const out = path.resolve(outArg || path.join(here, '..', id + '.mp4'));

const page = await openPage(W, H);
try {
  await page.load(pathToFileURL(path.join(here, tpl + '.html')).href + '?id=' + encodeURIComponent(id));
  const duration = await page.evaluate('window.DURATION');
  const shot = async (t) => {
    await page.evaluate(`window.seek(${t})`);
    return page.screenshot();
  };

  if (framesOpt) {
    for (const s of framesOpt.slice(9).split(',').map(Number)) {
      const file = path.join(path.dirname(out), `${id}-t${String(s).replace('.', '_')}.png`);
      writeFileSync(file, await shot(s));
      console.log(file);
    }
  } else {
    const ff = spawn('ffmpeg', ['-y', '-loglevel', 'error',
      '-f', 'image2pipe', '-framerate', String(FPS), '-c:v', 'png', '-i', '-',
      '-f', 'lavfi', '-i', 'anullsrc=channel_layout=stereo:sample_rate=48000',
      '-map', '0:v', '-map', '1:a', '-shortest',
      '-c:v', 'libx264', '-preset', 'slow', '-crf', '18', '-profile:v', 'high', '-pix_fmt', 'yuv420p', '-g', String(FPS * 2),
      '-c:a', 'aac', '-b:a', '128k', '-ar', '48000',
      '-use_editlist', '0', '-movflags', '+faststart', out], { stdio: ['pipe', 'inherit', 'inherit'] });
    const done = new Promise((r, j) => ff.on('close', (code) => code === 0 ? r() : j(new Error('ffmpeg が失敗しました（' + code + '）'))));
    const total = Math.round(duration * FPS);
    for (let f = 0; f < total; f++) {
      const png = await shot(f / FPS);
      if (!ff.stdin.write(png)) await new Promise((r) => ff.stdin.once('drain', r));
      if (f % 60 === 0) process.stdout.write(`\r${f}/${total}`);
    }
    ff.stdin.end();
    await done;
    console.log(`\r${total}/${total} → ${out}`);
  }
} finally {
  await page.close();
}

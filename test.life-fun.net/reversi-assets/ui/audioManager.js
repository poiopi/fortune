// D-0086：EffectManagerと対称な構造。Controllerから同じイベント（onStonePlaced/onStonesFlipped/
// onGameFinished）を受け取り、音を鳴らす責務だけを持つ。ゲーム状態・UI状態は一切知らない。
// 外部音源ファイルは使わず、Web Audio APIのオシレーター／ノイズ合成のみで音を作る。

const STORAGE_KEY = 'oseroFortune.audio.enabled';

export class AudioManager {
  constructor() {
    this._ctx = null;
    this.enabled = this._loadEnabled();
  }

  _loadEnabled() {
    try {
      const v = localStorage.getItem(STORAGE_KEY);
      return v === null ? true : v === 'true';
    } catch {
      return true;
    }
  }

  setEnabled(enabled) {
    this.enabled = enabled;
    try {
      localStorage.setItem(STORAGE_KEY, String(enabled));
    } catch {
      // localStorageが使えない環境（プライベートモード等）でも音の有効/無効自体は継続させる。
    }
  }

  /**
   * ブラウザの自動再生制約により、AudioContextは実際のユーザー操作の中で生成・再開する必要がある。
   * 何度呼んでも安全（既に生成・再開済みなら何もしない）。
   */
  resume() {
    if (!this._ctx) {
      const AudioContextClass = window.AudioContext || window.webkitAudioContext;
      this._ctx = new AudioContextClass();
    }
    if (this._ctx.state === 'suspended') {
      this._ctx.resume();
    }
  }

  /** 石が置かれた（反転を含む）ことの通知。木・石のタップ音（B案）を鳴らす。 */
  onStonePlaced() {
    if (!this.enabled || !this._ctx) return;
    this._playTap();
  }

  /**
   * D-0086：反転音は「反転セルごと」ではなく「1手につき1回」鳴らす（本人承認）。多数反転時に
   * 音が重なって騒がしくなることを避けるため。将来「大量反転時だけ音を強調する」等の拡張が
   * 必要になれば、flippedCells.lengthを使ってこの関数の内部だけで対応できる。
   * @param {{row:number, col:number, fromPlayer:string, toPlayer:string}[]} flippedCells
   */
  onStonesFlipped(flippedCells) {
    if (!this.enabled || !this._ctx) return;
    if (flippedCells.length === 0) return;
    this._playFlick();
  }

  /** 対局終了の通知。鐘の音を鳴らす。 */
  onGameFinished() {
    if (!this.enabled || !this._ctx) return;
    this._playBell();
  }

  /** 木・石のタップ音（B案）：短いノイズバーストをバンドパスで整形し、乾いた質感にする。 */
  _playTap() {
    const ctx = this._ctx;
    const now = ctx.currentTime;
    const duration = 0.06;

    const bufferSize = Math.max(1, Math.floor(ctx.sampleRate * duration));
    const buffer = ctx.createBuffer(1, bufferSize, ctx.sampleRate);
    const data = buffer.getChannelData(0);
    for (let i = 0; i < bufferSize; i++) data[i] = Math.random() * 2 - 1;

    const noise = ctx.createBufferSource();
    noise.buffer = buffer;

    const filter = ctx.createBiquadFilter();
    filter.type = 'bandpass';
    filter.frequency.value = 900;
    filter.Q.value = 1.2;

    const gain = ctx.createGain();
    gain.gain.setValueAtTime(0.5, now);
    gain.gain.exponentialRampToValueAtTime(0.001, now + duration);

    noise.connect(filter);
    filter.connect(gain);
    gain.connect(ctx.destination);
    noise.start(now);
    noise.stop(now + duration);
  }

  /** フリック音：三角波の周波数を短時間で下げ、弾くような質感にする。 */
  _playFlick() {
    const ctx = this._ctx;
    const now = ctx.currentTime;
    const duration = 0.09;

    const osc = ctx.createOscillator();
    osc.type = 'triangle';
    osc.frequency.setValueAtTime(650, now);
    osc.frequency.exponentialRampToValueAtTime(280, now + duration);

    const gain = ctx.createGain();
    gain.gain.setValueAtTime(0.25, now);
    gain.gain.exponentialRampToValueAtTime(0.001, now + duration);

    osc.connect(gain);
    gain.connect(ctx.destination);
    osc.start(now);
    osc.stop(now + duration + 0.02);
  }

  /** 鐘の音：基音＋倍音2本をわずかにデチューンして重ね、長めの減衰にする。 */
  _playBell() {
    const ctx = this._ctx;
    const now = ctx.currentTime;
    const duration = 1.2;
    const fundamental = 660;
    const partials = [1, 2.4, 3.8];

    partials.forEach((mult, i) => {
      const osc = ctx.createOscillator();
      osc.type = 'sine';
      osc.frequency.value = fundamental * mult;

      const gain = ctx.createGain();
      const peak = 0.2 / (i + 1);
      gain.gain.setValueAtTime(0, now);
      gain.gain.linearRampToValueAtTime(peak, now + 0.02);
      gain.gain.exponentialRampToValueAtTime(0.001, now + duration);

      osc.connect(gain);
      gain.connect(ctx.destination);
      osc.start(now);
      osc.stop(now + duration + 0.1);
    });
  }
}

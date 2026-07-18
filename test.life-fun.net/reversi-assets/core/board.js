// Java版 com.oserofortune.core.Board の移植。
// 標準8x8リバーシの盤面。D-0004（標準ルール・最後の1枚で終局）に従い、ルール変更は行わない。

import { Player, opponent } from './player.js';
import { Move } from './move.js';

const SIZE = 8;
const DX = [-1, -1, -1, 0, 0, 1, 1, 1];
const DY = [-1, 0, 1, -1, 1, -1, 0, 1];

export class Board {
  constructor() {
    /** @type {(string|null)[][]} */
    this.cells = Array.from({ length: SIZE }, () => Array(SIZE).fill(null));
    this.cells[3][3] = Player.WHITE;
    this.cells[3][4] = Player.BLACK;
    this.cells[4][3] = Player.BLACK;
    this.cells[4][4] = Player.WHITE;
  }

  static get SIZE() {
    return SIZE;
  }

  copy() {
    const b = new Board();
    b.cells = this.cells.map((row) => row.slice());
    return b;
  }

  at(row, col) {
    return this.cells[row][col];
  }

  static inBounds(r, c) {
    return r >= 0 && r < SIZE && c >= 0 && c < SIZE;
  }

  isLegalMove(player, row, col) {
    if (!Board.inBounds(row, col) || this.cells[row][col] !== null) return false;
    const opp = opponent(player);
    for (let d = 0; d < 8; d++) {
      let r = row + DX[d];
      let c = col + DY[d];
      let count = 0;
      while (Board.inBounds(r, c) && this.cells[r][c] === opp) {
        r += DX[d];
        c += DY[d];
        count++;
      }
      if (count > 0 && Board.inBounds(r, c) && this.cells[r][c] === player) return true;
    }
    return false;
  }

  /** @returns {Move[]} */
  legalMoves(player) {
    const moves = [];
    for (let r = 0; r < SIZE; r++) {
      for (let c = 0; c < SIZE; c++) {
        if (this.isLegalMove(player, r, c)) moves.push(new Move(r, c));
      }
    }
    return moves;
  }

  /** 盤面を破壊的に更新する。合法手であることは呼び出し側が保証する。 */
  applyMove(player, move) {
    if (move.isPass()) return;
    const opp = opponent(player);
    this.cells[move.row][move.col] = player;
    for (let d = 0; d < 8; d++) {
      let r = move.row + DX[d];
      let c = move.col + DY[d];
      let count = 0;
      while (Board.inBounds(r, c) && this.cells[r][c] === opp) {
        r += DX[d];
        c += DY[d];
        count++;
      }
      if (count > 0 && Board.inBounds(r, c) && this.cells[r][c] === player) {
        let cr = move.row + DX[d];
        let cc = move.col + DY[d];
        while (cr !== r || cc !== c) {
          this.cells[cr][cc] = player;
          cr += DX[d];
          cc += DY[d];
        }
      }
    }
  }

  isGameOver() {
    return this.legalMoves(Player.BLACK).length === 0 && this.legalMoves(Player.WHITE).length === 0;
  }

  countStones(player) {
    let n = 0;
    for (const row of this.cells) {
      for (const p of row) {
        if (p === player) n++;
      }
    }
    return n;
  }

  emptyCount() {
    let n = 0;
    for (const row of this.cells) {
      for (const p of row) {
        if (p === null) n++;
      }
    }
    return n;
  }

  /** OBS-003（危険マス）判定用：この盤面から、指定プレイヤーが角を取得できる手を持つか。 */
  canTakeAnyCorner(player) {
    const corners = [[0, 0], [0, 7], [7, 0], [7, 7]];
    return corners.some(([r, c]) => this.isLegalMove(player, r, c));
  }

  /**
   * 簡易的な確定石判定（OBS-016用）。角から連続して同色が続く辺上の石のみを「確定石」とみなす、
   * 簡略化されたヒューリスティック。完全な確定石理論は実装していない。
   */
  countStableStones(player) {
    const corners = [
      { pos: [0, 0], dirs: [[0, 1], [1, 0]] },
      { pos: [0, 7], dirs: [[0, -1], [1, 0]] },
      { pos: [7, 0], dirs: [[0, 1], [-1, 0]] },
      { pos: [7, 7], dirs: [[0, -1], [-1, 0]] },
    ];
    const stable = Array.from({ length: SIZE }, () => Array(SIZE).fill(false));
    for (const corner of corners) {
      const [cr, cc] = corner.pos;
      if (this.cells[cr][cc] !== player) continue;
      stable[cr][cc] = true;
      for (const [dr, dc] of corner.dirs) {
        this._markStableLine(cr, cc, dr, dc, player, stable);
      }
    }
    let n = 0;
    for (const row of stable) {
      for (const s of row) if (s) n++;
    }
    return n;
  }

  _markStableLine(r, c, dr, dc, player, stable) {
    let nr = r + dr;
    let nc = c + dc;
    while (Board.inBounds(nr, nc) && this.cells[nr][nc] === player) {
      stable[nr][nc] = true;
      nr += dr;
      nc += dc;
    }
  }
}

// Java版 com.oserofortune.core.Move の移植。

export class Move {
  /**
   * @param {number} row
   * @param {number} col
   */
  constructor(row, col) {
    this.row = row;
    this.col = col;
  }

  isPass() {
    return this.row === -1 && this.col === -1;
  }

  isCorner() {
    return (this.row === 0 || this.row === 7) && (this.col === 0 || this.col === 7);
  }

  /** @param {Move} other */
  equals(other) {
    return !!other && this.row === other.row && this.col === other.col;
  }

  toString() {
    return this.isPass() ? 'PASS' : `(${this.row},${this.col})`;
  }
}

export const PASS = new Move(-1, -1);

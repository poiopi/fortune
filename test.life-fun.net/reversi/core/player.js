// Java版 com.oserofortune.core.Player の移植。

export const Player = Object.freeze({
  BLACK: 'BLACK',
  WHITE: 'WHITE',
});

/**
 * @param {string} player
 * @returns {string}
 */
export function opponent(player) {
  return player === Player.BLACK ? Player.WHITE : Player.BLACK;
}

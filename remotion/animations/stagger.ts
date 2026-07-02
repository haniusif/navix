/**
 * Stagger helpers — turn a list length + per-item delay into frame offsets so
 * grids of cards / logos / nodes animate in a smooth cascade.
 */
export const staggerDelays = (count: number, step: number, start = 0): number[] =>
  Array.from({ length: count }, (_, i) => start + i * step);

/** Diagonal stagger for a grid (row + col weighting). */
export const gridStagger = (
  cols: number,
  index: number,
  step: number,
  start = 0,
): number => {
  const row = Math.floor(index / cols);
  const col = index % cols;
  return start + (row + col) * step;
};

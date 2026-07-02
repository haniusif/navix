import { interpolate, Easing } from 'remotion';

/** Clamp a number to a range. */
export const clamp = (v: number, min: number, max: number) =>
  Math.min(max, Math.max(min, v));

/** Linear map from one range to another (interpolate with clamping). */
export const mapRange = (
  v: number,
  inMin: number,
  inMax: number,
  outMin: number,
  outMax: number,
) =>
  interpolate(v, [inMin, inMax], [outMin, outMax], {
    extrapolateLeft: 'clamp',
    extrapolateRight: 'clamp',
  });

/** Deterministic per-index pseudo-random in [0,1) — safe for Remotion (no Math.random). */
export const seeded = (seed: number) => {
  const x = Math.sin(seed * 127.1 + 311.7) * 43758.5453;
  return x - Math.floor(x);
};

/** Distribute `count` items evenly across a span, returns their positions. */
export const distribute = (count: number, span: number, pad = 0) => {
  if (count <= 1) return [span / 2];
  const usable = span - pad * 2;
  return Array.from({ length: count }, (_, i) => pad + (usable * i) / (count - 1));
};

/** Point on a cubic Bézier — used for smooth route/flow paths. */
export const bezier = (
  t: number,
  p0: [number, number],
  p1: [number, number],
  p2: [number, number],
  p3: [number, number],
): [number, number] => {
  const mt = 1 - t;
  const a = mt * mt * mt;
  const b = 3 * mt * mt * t;
  const c = 3 * mt * t * t;
  const d = t * t * t;
  return [
    a * p0[0] + b * p1[0] + c * p2[0] + d * p3[0],
    a * p0[1] + b * p1[1] + c * p2[1] + d * p3[1],
  ];
};

/** Shared, brand-consistent easing curves. */
export const EASE = {
  /** The site's signature cubic-bezier(0.22, 1, 0.36, 1). */
  out: Easing.bezier(0.22, 1, 0.36, 1),
  inOut: Easing.bezier(0.65, 0, 0.35, 1),
  in: Easing.bezier(0.5, 0, 0.75, 0),
  linear: Easing.linear,
} as const;

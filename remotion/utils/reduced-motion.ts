/**
 * Reduced-motion helpers.
 *
 * In the browser (via @remotion/player) we honor the OS/browser setting.
 * During server-side video rendering the media query is unavailable, so we
 * treat "render" as full-motion (marketing videos always animate).
 */
export const prefersReducedMotion = (): boolean => {
  if (typeof window === 'undefined' || !window.matchMedia) return false;
  return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
};

/**
 * Returns `staticValue` when reduced motion is requested, otherwise `animated`.
 * Use inside compositions to collapse animation to its resting state.
 */
export const rm = <T,>(animated: T, staticValue: T): T =>
  prefersReducedMotion() ? staticValue : animated;

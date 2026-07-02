import { spring, useCurrentFrame, useVideoConfig, interpolate } from 'remotion';

export type EntranceConfig = {
  /** Frame to begin the entrance. */
  delay?: number;
  /** Spring damping — higher is stiffer/less bouncy. */
  damping?: number;
  /** Stiffness of the spring. */
  stiffness?: number;
  mass?: number;
};

/**
 * A reusable spring-driven entrance value in [0,1].
 * Compose it into translate/scale/opacity for consistent, brand-tuned motion.
 */
export const useEntrance = (config: EntranceConfig = {}): number => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();
  const { delay = 0, damping = 200, stiffness = 100, mass = 1 } = config;
  return spring({
    frame: frame - delay,
    fps,
    config: { damping, stiffness, mass },
  });
};

/** Convenience: fade + rise entrance styles, ready to spread onto a style object. */
export const useRiseIn = (config: EntranceConfig & { distance?: number } = {}) => {
  const p = useEntrance(config);
  const { distance = 40 } = config;
  return {
    opacity: p,
    transform: `translateY(${interpolate(p, [0, 1], [distance, 0])}px)`,
  };
};

/** Convenience: scale + fade entrance (good for cards/badges). */
export const usePopIn = (config: EntranceConfig & { from?: number } = {}) => {
  const p = useEntrance({ damping: 14, stiffness: 120, ...config });
  const { from = 0.85 } = config;
  return {
    opacity: interpolate(p, [0, 0.6], [0, 1], { extrapolateRight: 'clamp' }),
    transform: `scale(${interpolate(p, [0, 1], [from, 1])})`,
  };
};

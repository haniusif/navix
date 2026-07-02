import { interpolate, useCurrentFrame, useVideoConfig } from 'remotion';
import { EASE } from '../utils/math';

export type CounterConfig = {
  to: number;
  from?: number;
  /** Duration of the count in seconds. */
  durationInSeconds?: number;
  delay?: number;
  decimals?: number;
  /** Thousands separators (1,240). */
  group?: boolean;
  prefix?: string;
  suffix?: string;
};

/**
 * Animated number counter with easing — the video-grade version of the
 * website's IntersectionObserver counters.
 */
export const useCounter = (config: CounterConfig): string => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();
  const {
    to,
    from = 0,
    durationInSeconds = 2,
    delay = 0,
    decimals = 0,
    group = true,
    prefix = '',
    suffix = '',
  } = config;

  const value = interpolate(
    frame - delay,
    [0, durationInSeconds * fps],
    [from, to],
    { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: EASE.out },
  );

  const fixed = value.toFixed(decimals);
  const formatted = group
    ? Number(fixed).toLocaleString('en-US', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals,
      })
    : fixed;

  return `${prefix}${formatted}${suffix}`;
};

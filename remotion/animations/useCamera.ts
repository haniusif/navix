import { interpolate, useCurrentFrame, useVideoConfig } from 'remotion';
import { EASE } from '../utils/math';

export type CameraKeyframe = {
  /** Normalized time 0..1 across the composition (or [frame] if `absolute`). */
  at: number;
  x?: number;
  y?: number;
  scale?: number;
  rotate?: number;
};

export type CameraConfig = {
  keyframes: CameraKeyframe[];
  /** Interpret `at` as absolute frames instead of normalized time. */
  absolute?: boolean;
};

/**
 * A lightweight virtual camera. Returns a CSS transform string that can wrap a
 * scene <AbsoluteFill> to pan / zoom / dolly through it — the Apple-style
 * "camera move over a static scene" effect, done cheaply with transforms.
 */
export const useCamera = ({ keyframes, absolute = false }: CameraConfig): string => {
  const frame = useCurrentFrame();
  const { durationInFrames } = useVideoConfig();
  const t = absolute ? frame : frame / Math.max(1, durationInFrames);

  const times = keyframes.map((k) => k.at);
  const lerp = (pick: (k: CameraKeyframe) => number | undefined, fallback: number) => {
    const values = keyframes.map((k) => pick(k) ?? fallback);
    return interpolate(t, times, values, {
      extrapolateLeft: 'clamp',
      extrapolateRight: 'clamp',
      easing: EASE.inOut,
    });
  };

  const x = lerp((k) => k.x, 0);
  const y = lerp((k) => k.y, 0);
  const scale = lerp((k) => k.scale, 1);
  const rotate = lerp((k) => k.rotate, 0);

  return `translate(${x}px, ${y}px) scale(${scale}) rotate(${rotate}deg)`;
};

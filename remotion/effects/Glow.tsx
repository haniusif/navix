import React from 'react';
import { useCurrentFrame, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';

export type GlowProps = {
  x?: number | string;
  y?: number | string;
  size?: number;
  color?: string;
  /** Pulse amplitude 0..1. */
  pulse?: number;
  speed?: number;
  opacity?: number;
};

/** A soft radial glow orb that gently breathes — the brand's signature accent. */
export const Glow: React.FC<GlowProps> = ({
  x = '50%',
  y = '50%',
  size = 700,
  color = COLORS.primary,
  pulse = 0.15,
  speed = 1,
  opacity = 0.5,
}) => {
  const frame = useCurrentFrame();
  const breath = interpolate(
    Math.sin((frame * speed) / 22),
    [-1, 1],
    [1 - pulse, 1 + pulse],
  );
  return (
    <div
      style={{
        position: 'absolute',
        left: x,
        top: y,
        width: size,
        height: size,
        transform: `translate(-50%, -50%) scale(${breath})`,
        borderRadius: '50%',
        background: `radial-gradient(circle, ${color}, transparent 65%)`,
        opacity,
        filter: 'blur(20px)',
        pointerEvents: 'none',
      }}
    />
  );
};

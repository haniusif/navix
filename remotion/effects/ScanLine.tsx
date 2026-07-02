import React from 'react';
import { useCurrentFrame, useVideoConfig, interpolate } from 'remotion';
import { COLORS } from '../utils/theme';

export type ScanLineProps = {
  color?: string;
  /** 'horizontal' sweeps top→bottom, 'vertical' sweeps left→right. */
  direction?: 'horizontal' | 'vertical';
  thickness?: number;
  /** Sweeps per second. */
  frequency?: number;
  glow?: number;
};

/**
 * A laser scan sweep — the core of the barcode-scanner effect, but reusable as
 * a "system is reading" motif over any panel.
 */
export const ScanLine: React.FC<ScanLineProps> = ({
  color = COLORS.primary,
  direction = 'horizontal',
  thickness = 3,
  frequency = 0.5,
  glow = 16,
}) => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();
  const cycle = (frame * frequency) / fps;
  const p = cycle - Math.floor(cycle); // 0..1 saw
  const pos = interpolate(Math.sin(p * Math.PI), [0, 1], [0, 100]);
  const horizontal = direction === 'horizontal';

  return (
    <div
      style={{
        position: 'absolute',
        left: horizontal ? 0 : `${pos}%`,
        top: horizontal ? `${pos}%` : 0,
        width: horizontal ? '100%' : thickness,
        height: horizontal ? thickness : '100%',
        background: color,
        boxShadow: `0 0 ${glow}px ${glow / 2}px ${color}`,
        opacity: 0.9,
        pointerEvents: 'none',
      }}
    />
  );
};

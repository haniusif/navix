import React from 'react';
import { COLORS } from '../utils/theme';

export type NodeProps = {
  size?: number;
  color?: string;
  /** 0..1 pulse ring progress; drive from frame for a radar ping. */
  pulse?: number;
  label?: string;
  active?: boolean;
};

/** A network waypoint / hub node with an expanding ping ring. */
export const Node: React.FC<NodeProps> = ({
  size = 22,
  color = COLORS.primary,
  pulse = 0,
  label,
  active = true,
}) => (
  <div style={{ position: 'relative', width: size, height: size }}>
    {pulse > 0 && (
      <div
        style={{
          position: 'absolute',
          inset: 0,
          margin: 'auto',
          width: size,
          height: size,
          borderRadius: '50%',
          border: `2px solid ${color}`,
          transform: `scale(${1 + pulse * 3})`,
          opacity: 1 - pulse,
        }}
      />
    )}
    <div
      style={{
        width: size,
        height: size,
        borderRadius: '50%',
        background: active ? color : COLORS.muted2,
        boxShadow: active ? `0 0 16px ${color}` : 'none',
        border: `2px solid ${COLORS.bg}`,
      }}
    />
    {label && (
      <span
        style={{
          position: 'absolute',
          top: size + 6,
          left: '50%',
          transform: 'translateX(-50%)',
          whiteSpace: 'nowrap',
          fontFamily: 'Space Grotesk, sans-serif',
          fontSize: 13,
          color: COLORS.muted,
        }}
      >
        {label}
      </span>
    )}
  </div>
);

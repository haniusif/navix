import React from 'react';
import { COLORS } from '../utils/theme';

export type ContainerProps = {
  width?: number;
  color?: string;
  code?: string;
};

/** An intermodal shipping container with corrugation and a code stencil. */
export const Container: React.FC<ContainerProps> = ({
  width = 260,
  color = COLORS.primary,
  code = 'NVX 4471',
}) => {
  const height = width * (120 / 260);
  return (
    <svg width={width} height={height} viewBox="0 0 260 120">
      <rect x={2} y={2} width={256} height={116} rx={6} fill={color} stroke="#0a0f18" strokeWidth={3} />
      {Array.from({ length: 15 }).map((_, i) => (
        <rect key={i} x={12 + i * 16} y={10} width={8} height={100} fill="rgba(0,0,0,0.12)" />
      ))}
      <rect x={2} y={2} width={256} height={116} rx={6} fill="url(#cshade)" />
      <defs>
        <linearGradient id="cshade" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stopColor="#fff" stopOpacity={0.12} />
          <stop offset="100%" stopColor="#000" stopOpacity={0.2} />
        </linearGradient>
      </defs>
      <text x={130} y={68} textAnchor="middle" fontFamily="Space Grotesk, monospace" fontWeight={700} fontSize={22} fill="#0a0f18">
        {code}
      </text>
    </svg>
  );
};

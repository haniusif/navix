import React from 'react';
import { COLORS } from '../utils/theme';
import { seeded } from '../utils/math';

export type BarcodeProps = {
  width?: number;
  height?: number;
  bars?: number;
  color?: string;
  /** 0..1 how many bars have been "read" (draw progress). */
  progress?: number;
  code?: string;
};

/** A deterministic barcode; `progress` reveals bars left→right for scan scenes. */
export const Barcode: React.FC<BarcodeProps> = ({
  width = 360,
  height = 130,
  bars = 44,
  color = COLORS.white,
  progress = 1,
  code = 'NVX 8829 4471 0021',
}) => {
  const revealed = Math.round(bars * progress);
  let x = 8;
  const rects: React.ReactElement[] = [];
  for (let i = 0; i < bars; i++) {
    const w = 2 + seeded(i + 1) * 6;
    if (i % 2 === 0) {
      rects.push(
        <rect
          key={i}
          x={x}
          y={8}
          width={w}
          height={height - 44}
          fill={color}
          opacity={i < revealed ? 1 : 0.15}
        />,
      );
    }
    x += w + 3;
  }
  return (
    <svg width={width} height={height} viewBox={`0 0 ${x + 8} ${height}`}>
      <rect width="100%" height="100%" rx={10} fill={COLORS.surface} stroke={COLORS.border} />
      {rects}
      <text
        x={(x + 8) / 2}
        y={height - 14}
        textAnchor="middle"
        fontFamily="Space Grotesk, monospace"
        fontSize={16}
        letterSpacing={3}
        fill={COLORS.muted}
      >
        {code}
      </text>
    </svg>
  );
};

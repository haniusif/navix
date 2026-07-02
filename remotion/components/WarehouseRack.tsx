import React from 'react';
import { COLORS } from '../utils/theme';
import { seeded } from '../utils/math';

export type WarehouseRackProps = {
  width?: number;
  levels?: number;
  bays?: number;
  color?: string;
  /** 0..1 how filled the rack is (bays populate as it rises). */
  fill?: number;
  seed?: number;
};

/** Pallet racking with boxes — the backbone of the warehouse scenes. */
export const WarehouseRack: React.FC<WarehouseRackProps> = ({
  width = 320,
  levels = 4,
  bays = 4,
  color = COLORS.primary,
  fill = 1,
  seed = 1,
}) => {
  const height = width * 1.1;
  const beam = COLORS.muted2;
  const cellW = width / bays;
  const cellH = height / levels;
  const total = levels * bays;
  const filled = Math.round(total * fill);

  return (
    <svg width={width} height={height} viewBox={`0 0 ${width} ${height}`}>
      {/* uprights */}
      {Array.from({ length: bays + 1 }).map((_, i) => (
        <rect key={`u${i}`} x={i * cellW - 3} y={0} width={6} height={height} fill={beam} />
      ))}
      {/* beams + pallets */}
      {Array.from({ length: levels }).map((_, r) =>
        Array.from({ length: bays }).map((_, c) => {
          const idx = r * bays + c;
          const isFilled = idx < filled;
          const bx = c * cellW;
          const by = r * cellH;
          const boxColor = seeded(idx + seed) > 0.7 ? color : COLORS.surface2;
          return (
            <g key={`c${r}-${c}`}>
              <rect x={bx} y={by + cellH - 5} width={cellW} height={5} fill={beam} />
              {isFilled && (
                <rect
                  x={bx + 8}
                  y={by + cellH * 0.32}
                  width={cellW - 16}
                  height={cellH * 0.6}
                  rx={3}
                  fill={boxColor}
                  stroke="#0a0f18"
                  strokeWidth={1.5}
                  opacity={0.95}
                />
              )}
            </g>
          );
        }),
      )}
    </svg>
  );
};

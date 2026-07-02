import React from 'react';
import { AbsoluteFill, useCurrentFrame, useVideoConfig, interpolate, spring } from 'remotion';
import { COLORS, FONTS } from '../utils/theme';
import { EASE } from '../utils/math';
import { Barcode } from '../components/Barcode';
import { ScanLine } from '../effects/ScanLine';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { Icons } from '../assets/icons';

export type BarcodeScannerProps = {
  code?: string;
  accent?: string;
  transparent?: boolean;
};

/**
 * Barcode scan-and-verify: a laser sweeps the barcode, bars light up as they're
 * "read", then a success check springs in. Combines ScanLine + progressive
 * barcode reveal + a spring confirmation.
 */
export const BarcodeScanner: React.FC<BarcodeScannerProps> = ({
  code = 'NVX 8829 4471 0021',
  accent = COLORS.primary,
  transparent = false,
}) => {
  const frame = useCurrentFrame();
  const { fps, durationInFrames } = useVideoConfig();

  const readP = interpolate(frame, [10, durationInFrames * 0.55], [0, 1], { extrapolateLeft: 'clamp', extrapolateRight: 'clamp', easing: EASE.out });
  const verified = frame > durationInFrames * 0.6;
  const check = spring({ frame: frame - durationInFrames * 0.6, fps, config: { damping: 12 } });

  return (
    <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden', alignItems: 'center', justifyContent: 'center' }}>
      {!transparent && <AnimatedGradient background={COLORS.bg} colors={[accent, COLORS.info]} speed={0.4} opacity={0.16} />}

      <div style={{ position: 'relative', padding: 30, borderRadius: 26, background: COLORS.surface, border: `1px solid ${COLORS.border}`, boxShadow: '0 30px 80px -30px rgba(0,0,0,0.7)' }}>
        <div style={{ position: 'relative', overflow: 'hidden', borderRadius: 12 }}>
          <Barcode width={520} height={180} progress={readP} code={code} color={COLORS.white} />
          {!verified && <ScanLine color={accent} frequency={0.8} thickness={4} glow={20} />}
          {/* corner brackets */}
          {[
            { top: 8, left: 8, rot: 0 },
            { top: 8, right: 8, rot: 90 },
            { bottom: 8, right: 8, rot: 180 },
            { bottom: 8, left: 8, rot: 270 },
          ].map((b, i) => (
            <div key={i} style={{ position: 'absolute', ...b, width: 26, height: 26, borderTop: `3px solid ${accent}`, borderLeft: `3px solid ${accent}`, transform: `rotate(${b.rot}deg)` }} />
          ))}
        </div>

        <div style={{ marginTop: 22, display: 'flex', alignItems: 'center', justifyContent: 'center', gap: 12, height: 40 }}>
          {verified ? (
            <div style={{ display: 'flex', alignItems: 'center', gap: 10, color: COLORS.success, opacity: check, transform: `scale(${check})` }}>
              <div style={{ width: 30, height: 30, borderRadius: '50%', background: COLORS.success, display: 'grid', placeItems: 'center', color: COLORS.bg }}>
                {Icons.check({ width: 18, height: 18, strokeWidth: 3 })}
              </div>
              <span style={{ fontFamily: FONTS.display, fontWeight: 700, fontSize: 20 }}>Scanned &amp; verified</span>
            </div>
          ) : (
            <span style={{ color: COLORS.muted, fontFamily: 'Space Grotesk, monospace', fontSize: 18 }}>
              READING… {Math.round(readP * 100)}%
            </span>
          )}
        </div>
      </div>
    </AbsoluteFill>
  );
};

import React from 'react';
import { AbsoluteFill } from 'remotion';
import { COLORS } from '../utils/theme';
import { AnimatedGradient } from '../effects/AnimatedGradient';
import { GridOverlay } from '../effects/GridOverlay';
import { Particles } from '../effects/Particles';
import { Glow } from '../effects/Glow';
import { Grain } from '../effects/Grain';

export type AmbientBackgroundProps = {
  accent?: string;
  /** Toggle individual layers to tune weight per section. */
  grid?: boolean;
  particles?: boolean;
  grain?: boolean;
  intensity?: number;
  transparent?: boolean;
};

/**
 * A reusable, seamlessly-looping ambient backdrop — the general-purpose
 * "section background" used anywhere a bit of quiet life is wanted. Every layer
 * is optional so it scales from ultra-light to rich.
 */
export const AmbientBackground: React.FC<AmbientBackgroundProps> = ({
  accent = COLORS.primary,
  grid = true,
  particles = true,
  grain = true,
  intensity = 1,
  transparent = false,
}) => (
  <AbsoluteFill style={{ background: transparent ? 'transparent' : COLORS.bg, overflow: 'hidden' }}>
    <AnimatedGradient background="transparent" colors={[accent, COLORS.info, COLORS.primaryDeep]} speed={0.4} opacity={0.35 * intensity} />
    <Glow x="20%" y="30%" size={640} color={accent} opacity={0.22 * intensity} />
    <Glow x="82%" y="72%" size={560} color={COLORS.info} opacity={0.16 * intensity} />
    {grid && <GridOverlay cell={70} scroll={0.06} opacity={0.4} />}
    {particles && <Particles count={Math.round(28 * intensity)} opacity={0.4 * intensity} />}
    {grain && <Grain opacity={0.05} />}
  </AbsoluteFill>
);

import type React from 'react';
import { VIDEO } from '../utils/theme';
import { HeroCinematic } from '../compositions/HeroCinematic';
import { CtaBackground } from '../compositions/CtaBackground';
import { AmbientBackground } from '../compositions/AmbientBackground';
import { RouteVisualization } from '../compositions/RouteVisualization';

export type MotionEntry = {
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  component: React.ComponentType<any>;
  durationInFrames: number;
  fps: number;
  width: number;
  height: number;
  loop: boolean;
  inputProps: Record<string, unknown>;
};

/**
 * The compositions approved for LIVE embedding on the site (the "2-3 marquee
 * moments" from the hybrid plan). Everything else ships as pre-rendered <video>
 * or lives in Studio only — keeping the live JS surface tiny.
 *
 * All web variants use `background/transparent` so they layer over the existing,
 * finalized UI without changing it.
 */
export const MOTION_REGISTRY: Record<string, MotionEntry> = {
  hero: {
    component: HeroCinematic,
    durationInFrames: 300,
    fps: VIDEO.fps,
    width: 1920,
    height: 1080,
    loop: true,
    inputProps: { background: 'none' },
  },
  cta: {
    component: CtaBackground,
    durationInFrames: 300,
    fps: VIDEO.fps,
    width: 1920,
    height: 640,
    loop: true,
    inputProps: { transparent: true, variant: 'orange' },
  },
  ambient: {
    component: AmbientBackground,
    durationInFrames: 300,
    fps: VIDEO.fps,
    width: 1920,
    height: 1080,
    loop: true,
    inputProps: { transparent: true, intensity: 0.8 },
  },
  track: {
    component: RouteVisualization,
    durationInFrames: 300,
    fps: VIDEO.fps,
    width: 1920,
    height: 1080,
    loop: true,
    inputProps: { transparent: true },
  },
};

export type MotionKey = keyof typeof MOTION_REGISTRY;

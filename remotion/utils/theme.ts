/**
 * NAVIX motion design tokens.
 * Mirrors the website's dark-luxury palette so every composition is on-brand
 * whether it renders to a marketing video or plays live in the browser.
 */
export const COLORS = {
  bg: '#07111F',
  secondary: '#0F172A',
  surface: '#111C2E',
  surface2: '#16233A',
  primary: '#FF7A1A',
  primaryLight: '#FF9A4D',
  primaryDeep: '#E8620A',
  white: '#FFFFFF',
  muted: '#94A3B8',
  muted2: '#64748B',
  border: 'rgba(255,255,255,0.08)',
  borderStrong: 'rgba(255,255,255,0.14)',
  success: '#4ADE80',
  info: '#60A5FA',
} as const;

export const FONTS = {
  display: "'Space Grotesk', 'Inter', 'Tajawal', system-ui, sans-serif",
  body: "'Inter', 'IBM Plex Sans Arabic', system-ui, sans-serif",
  num: "'Space Grotesk', monospace",
} as const;

/** Global render defaults. Individual compositions can override dimensions. */
export const VIDEO = {
  fps: 30,
  width: 1920,
  height: 1080,
} as const;

/** Common canvas presets used across compositions. */
export const CANVAS = {
  landscape: { width: 1920, height: 1080 },
  hero: { width: 1920, height: 1200 },
  banner: { width: 1920, height: 640 },
  square: { width: 1080, height: 1080 },
  widget: { width: 1200, height: 800 },
} as const;

export type ColorToken = keyof typeof COLORS;

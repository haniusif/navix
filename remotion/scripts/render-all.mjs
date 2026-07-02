/**
 * Render every NAVIX composition to a marketing-ready MP4 in ./out.
 * Usage: npm run render:all
 *
 * Thin wrapper over the Remotion CLI so it works without the programmatic
 * renderer API. The first render downloads a headless Chromium (~1x, cached).
 */
import { spawnSync } from 'node:child_process';
import { mkdirSync } from 'node:fs';

const IDS = [
  'HeroCinematic',
  'AmbientBackground',
  'CtaBackground',
  'TruckMovement',
  'WarehouseEnvironment',
  'WarehouseAutomation',
  'RouteVisualization',
  'SupplyChainFlow',
  'FloatingKpiCards',
  'DashboardWidgets',
  'StatsCounter',
  'BarcodeScanner',
  'PackageTracking',
  'IntegrationLogos',
  'LoadingAnimation',
  'SectionTransition',
];

mkdirSync('out', { recursive: true });

for (const id of IDS) {
  console.log(`\n▶ Rendering ${id} …`);
  const res = spawnSync(
    'npx',
    ['remotion', 'render', 'remotion/index.ts', id, `out/${id}.mp4`],
    { stdio: 'inherit', shell: false },
  );
  if (res.status !== 0) {
    console.error(`✖ Failed to render ${id}`);
    process.exitCode = 1;
  }
}
console.log('\n✔ Done. Videos in ./out');

/**
 * Render the section-background compositions to looping MP4s in public/motion/,
 * so the website can embed them as lightweight <video> tags (the "pre-rendered
 * for the rest" half of the hybrid strategy). The Blade partials auto-upgrade
 * to <video> when these files exist, and fall back to the static UI otherwise.
 *
 * Usage: npm run render:web
 */
import { spawnSync } from 'node:child_process';
import { mkdirSync } from 'node:fs';

// [compositionId, outputFile, extra CLI flags]
const TARGETS = [
  ['WarehouseEnvironment', 'warehouse.mp4', []],
  ['SupplyChainFlow', 'supply-chain.mp4', []],
  ['RouteVisualization', 'route.mp4', []],
  ['DashboardWidgets', 'dashboard.mp4', []],
  ['IntegrationLogos', 'integrations.mp4', []],
];

mkdirSync('public/motion', { recursive: true });

for (const [id, out, extra] of TARGETS) {
  console.log(`\n▶ Rendering ${id} → public/motion/${out} …`);
  const res = spawnSync(
    'npx',
    ['remotion', 'render', 'remotion/index.ts', id, `public/motion/${out}`, '--muted', ...extra],
    { stdio: 'inherit', shell: false },
  );
  if (res.status !== 0) {
    console.error(`✖ Failed to render ${id}`);
    process.exitCode = 1;
  }
}
console.log('\n✔ Section background videos written to public/motion/');

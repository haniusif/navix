import { Config } from '@remotion/cli/config';

/**
 * Remotion CLI configuration for NAVIX marketing-video rendering.
 * Entry point registers every composition in remotion/Root.tsx.
 */
Config.setEntryPoint('./remotion/index.ts');
Config.setVideoImageFormat('jpeg');
Config.setOverwriteOutput(true);
Config.setConcurrency(null); // auto
// Transparent WebM export for compositions that layer over the live site.
Config.setPixelFormat('yuv420p');

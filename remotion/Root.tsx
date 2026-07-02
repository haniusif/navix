import React from 'react';
import { Composition, Folder } from 'remotion';
import { VIDEO, CANVAS } from './utils/theme';

import { HeroCinematic } from './compositions/HeroCinematic';
import { WarehouseEnvironment } from './compositions/WarehouseEnvironment';
import { TruckMovement } from './compositions/TruckMovement';
import { FloatingKpiCards } from './compositions/FloatingKpiCards';
import { DashboardWidgets } from './compositions/DashboardWidgets';
import { StatsCounter } from './compositions/StatsCounter';
import { RouteVisualization } from './compositions/RouteVisualization';
import { SupplyChainFlow } from './compositions/SupplyChainFlow';
import { WarehouseAutomation } from './compositions/WarehouseAutomation';
import { BarcodeScanner } from './compositions/BarcodeScanner';
import { PackageTracking } from './compositions/PackageTracking';
import { IntegrationLogos } from './compositions/IntegrationLogos';
import { CtaBackground } from './compositions/CtaBackground';
import { AmbientBackground } from './compositions/AmbientBackground';
import { LoadingAnimation } from './compositions/LoadingAnimation';
import { SectionTransition } from './compositions/SectionTransition';

const { fps } = VIDEO;

/**
 * Remotion registry — every NAVIX composition, grouped for Studio.
 * `npx remotion studio remotion/index.ts` to preview,
 * `npx remotion render <id> out/<id>.mp4` to render marketing videos.
 */
export const RemotionRoot: React.FC = () => (
  <>
    <Folder name="Hero-and-Backgrounds">
      <Composition
        id="HeroCinematic"
        component={HeroCinematic}
        durationInFrames={300}
        fps={fps}
        width={CANVAS.hero.width}
        height={CANVAS.hero.height}
        defaultProps={{ background: 'photo' as const, kenBurns: true }}
      />
      <Composition
        id="AmbientBackground"
        component={AmbientBackground}
        durationInFrames={300}
        fps={fps}
        width={CANVAS.landscape.width}
        height={CANVAS.landscape.height}
        defaultProps={{ intensity: 1 }}
      />
      <Composition
        id="CtaBackground"
        component={CtaBackground}
        durationInFrames={300}
        fps={fps}
        width={CANVAS.banner.width}
        height={CANVAS.banner.height}
        defaultProps={{ variant: 'orange' as const }}
      />
    </Folder>

    <Folder name="Logistics-Scenes">
      <Composition id="TruckMovement" component={TruckMovement} durationInFrames={180} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{ direction: 'ltr' as const, motionBlur: true }} />
      <Composition id="WarehouseEnvironment" component={WarehouseEnvironment} durationInFrames={240} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{ rackCount: 4, camera: true }} />
      <Composition id="WarehouseAutomation" component={WarehouseAutomation} durationInFrames={240} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
      <Composition id="RouteVisualization" component={RouteVisualization} durationInFrames={300} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
      <Composition id="SupplyChainFlow" component={SupplyChainFlow} durationInFrames={240} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
    </Folder>

    <Folder name="Data-and-Tracking">
      <Composition id="FloatingKpiCards" component={FloatingKpiCards} durationInFrames={180} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
      <Composition id="DashboardWidgets" component={DashboardWidgets} durationInFrames={240} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
      <Composition id="StatsCounter" component={StatsCounter} durationInFrames={150} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
      <Composition id="BarcodeScanner" component={BarcodeScanner} durationInFrames={150} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
      <Composition id="PackageTracking" component={PackageTracking} durationInFrames={240} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{}} />
    </Folder>

    <Folder name="Brand-and-Utility">
      <Composition id="IntegrationLogos" component={IntegrationLogos} durationInFrames={210} fps={fps} width={CANVAS.square.width} height={CANVAS.square.height} defaultProps={{}} />
      <Composition id="LoadingAnimation" component={LoadingAnimation} durationInFrames={90} fps={fps} width={720} height={720} defaultProps={{ label: 'NAVIX' }} />
      <Composition id="SectionTransition" component={SectionTransition} durationInFrames={210} fps={fps} width={CANVAS.landscape.width} height={CANVAS.landscape.height} defaultProps={{ kind: 'slide' as const }} />
    </Folder>
  </>
);

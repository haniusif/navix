@php $isRtl = app()->getLocale() === 'ar'; @endphp
@extends('layouts.site', [
    'activeNav' => 'track',
    'navHome' => $isRtl ? url('/') : url('/en'),
    'anchorBase' => $isRtl ? url('/') : url('/en'),
    'switchUrl' => $isRtl ? url('/en/track') : url('/track'),
])

@section('title', __('tracking.meta.title'))
@section('description', __('tracking.meta.description'))

@push('styles')
<style>
  .track-hero { position: relative; padding: 170px 0 70px; overflow: hidden; background: linear-gradient(180deg, var(--secondary), var(--bg)); }
  .track-hero-motion { position: absolute; inset: 0; z-index: 0; opacity: 0.45; pointer-events: none; }
  .track-hero-glow { position: absolute; z-index: 0; top: -160px; inset-inline-end: -120px; width: 620px; height: 620px; border-radius: 50%; background: radial-gradient(circle, rgba(255,122,26,0.16), transparent 65%); pointer-events: none; }
  .track-hero .container { position: relative; z-index: 2; max-width: 820px; text-align: center; }
  .track-hero h1 { font-family: var(--font-display); font-weight: 800; font-size: clamp(36px, 5.4vw, 64px); line-height: 1.05; letter-spacing: -0.02em; margin-top: 18px; }
  .track-hero h1 .accent { background: linear-gradient(120deg, var(--primary-light), var(--primary)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
  .track-hero p { color: var(--muted); font-size: 18px; max-width: 620px; margin: 18px auto 0; line-height: 1.7; }

  .search-form { display: flex; gap: 12px; max-width: 640px; margin: 36px auto 0; }
  .search-input { flex: 1; background: rgba(17,28,46,0.75); backdrop-filter: blur(10px); border: 1px solid var(--border-strong); border-radius: 999px; padding: 17px 24px; color: var(--white); font-size: 15px; font-family: var(--font-body); outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
  .search-input::placeholder { color: var(--muted-2); }
  .search-input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(255,122,26,0.12); }
  .search-form .btn { flex-shrink: 0; }
  .demo-hint { margin-top: 16px; color: var(--muted); font-size: 13.5px; }
  .demo-hint button { background: none; border: none; color: var(--primary-light); font-weight: 600; cursor: pointer; font-family: var(--font-num); font-size: 13.5px; padding: 0; }
  .demo-hint button:hover { text-decoration: underline; }
  .track-error { display: none; margin-top: 16px; color: #FCA5A5; font-size: 14px; }
  .track-error.show { display: block; }

  .track-result { padding: 50px 0 60px; }
  .track-empty { text-align: center; padding: 30px 20px 10px; }
  .track-empty-ico { width: 66px; height: 66px; margin: 0 auto 18px; border-radius: 18px; background: rgba(255,122,26,0.1); border: 1px solid rgba(255,122,26,0.18); color: var(--primary-light); display: grid; place-items: center; }
  .track-empty p { color: var(--muted); max-width: 440px; margin: 0 auto; font-size: 15px; line-height: 1.7; }
  .ship-result[hidden] { display: none; }
  .ship-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); padding: 32px; box-shadow: var(--shadow-card); }
  .ship-head { display: flex; justify-content: space-between; align-items: center; gap: 18px; flex-wrap: wrap; padding-bottom: 26px; border-bottom: 1px solid var(--border); }
  .ship-head .label { color: var(--muted); font-size: 13px; letter-spacing: 0.04em; }
  .ship-number-row { display: flex; align-items: center; gap: 12px; margin-top: 6px; }
  .ship-number { font-family: var(--font-num); font-weight: 700; font-size: 26px; color: var(--white); letter-spacing: 0.02em; }
  .copy-btn { background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--muted); width: 34px; height: 34px; border-radius: 9px; display: grid; place-items: center; cursor: pointer; transition: all 0.2s; }
  .copy-btn:hover { color: var(--primary-light); border-color: rgba(255,122,26,0.35); }
  .status-badge { display: inline-flex; align-items: center; gap: 9px; padding: 10px 18px; border-radius: 999px; background: rgba(74,222,128,0.12); color: var(--success); border: 1px solid rgba(74,222,128,0.3); font-weight: 600; font-family: var(--font-display); font-size: 14px; }
  .status-badge .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--success); box-shadow: 0 0 0 4px rgba(74,222,128,0.18); animation: pulse-dot 1.8s var(--ease) infinite; }
  @keyframes pulse-dot { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.4); } }
  /* status-badge color variants (set by JS from the API status) */
  .status-badge.st-orange { background: rgba(255,122,26,0.12); color: var(--primary-light); border-color: rgba(255,122,26,0.3); }
  .status-badge.st-orange .dot { background: var(--primary); box-shadow: 0 0 0 4px rgba(255,122,26,0.18); }
  .status-badge.st-red { background: rgba(248,113,113,0.12); color: #FCA5A5; border-color: rgba(248,113,113,0.3); }
  .status-badge.st-red .dot { background: #F87171; box-shadow: 0 0 0 4px rgba(248,113,113,0.18); }
  .status-badge.st-muted { background: rgba(148,163,184,0.12); color: var(--muted); border-color: var(--border-strong); }
  .status-badge.st-muted .dot { background: var(--muted-2); box-shadow: none; animation: none; }
  /* loading state */
  .ship-card.is-loading { opacity: 0.55; pointer-events: none; }
  .tl-loading { display: flex; align-items: center; gap: 10px; color: var(--muted); font-size: 14px; padding: 8px 0; }
  .tl-spinner { width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--border-strong); border-top-color: var(--primary); animation: tl-spin 0.8s linear infinite; }
  @keyframes tl-spin { to { transform: rotate(360deg); } }

  .ship-meta { display: flex; flex-wrap: wrap; gap: 22px 44px; margin-top: 26px; }
  .meta-item { display: flex; gap: 13px; align-items: flex-start; flex: 0 1 auto; min-width: 170px; }
  .meta-ico { width: 40px; height: 40px; flex-shrink: 0; border-radius: 11px; background: rgba(255,122,26,0.12); border: 1px solid rgba(255,122,26,0.18); color: var(--primary-light); display: grid; place-items: center; }
  .meta-label { color: var(--muted); font-size: 12.5px; }
  .meta-value { color: var(--white); font-weight: 600; font-size: 15px; margin-top: 2px; }

  .progress-wrap { margin-top: 30px; }
  .progress-top { display: flex; justify-content: space-between; color: var(--muted); font-size: 13px; margin-bottom: 18px; }

  /* 5-step progress bar */
  .stepper { position: relative; }
  .stepper-rail { position: absolute; top: 10px; inset-inline: 11px; height: 3px; background: var(--border); border-radius: 3px; }
  .stepper-fill { position: absolute; top: 0; inset-inline-start: 0; height: 100%; width: 0; background: linear-gradient(90deg, var(--primary), var(--primary-light)); border-radius: 3px; box-shadow: 0 0 14px var(--primary); transition: width 1s var(--ease); }
  [dir="rtl"] .stepper-fill { background: linear-gradient(270deg, var(--primary), var(--primary-light)); }
  .stepper.is-fail .stepper-fill { background: #F87171; box-shadow: 0 0 14px #F87171; }
  .stepper-nodes { position: relative; display: flex; justify-content: space-between; }
  .step-node { display: flex; flex-direction: column; align-items: center; gap: 12px; flex: 1 1 0; text-align: center; }
  .sn-dot { width: 22px; height: 22px; border-radius: 50%; background: var(--surface-2); border: 2px solid var(--border); transition: background 0.3s var(--ease), border-color 0.3s var(--ease), box-shadow 0.3s var(--ease); }
  .step-node.done .sn-dot { background: var(--primary); border-color: var(--primary); }
  .step-node.current .sn-dot { background: var(--primary); border-color: var(--primary); box-shadow: 0 0 0 5px rgba(255,122,26,0.18); }
  .stepper.is-fail .step-node.current .sn-dot { background: #F87171; border-color: #F87171; box-shadow: 0 0 0 5px rgba(248,113,113,0.18); }
  .sn-label { font-size: 12.5px; color: var(--muted); max-width: 92px; line-height: 1.4; }
  .step-node.done .sn-label, .step-node.current .sn-label { color: var(--white); }

  .ship-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 22px; }
  .panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 28px; }
  .panel-title { font-family: var(--font-display); font-weight: 700; font-size: 18px; color: var(--white); margin-bottom: 24px; }
  .panel-sub { color: var(--muted); font-size: 13px; font-weight: 400; margin-top: 2px; }

  /* Vertical timeline */
  .timeline { position: relative; }
  .tl-step { display: grid; grid-template-columns: 42px 1fr; gap: 16px; padding-bottom: 26px; position: relative; }
  .tl-step:last-child { padding-bottom: 0; }
  .tl-step:not(:last-child)::before { content: ""; position: absolute; top: 42px; inset-inline-start: 20px; width: 2px; bottom: 4px; background: var(--border); }
  .tl-step.done:not(:last-child)::before { background: linear-gradient(180deg, var(--primary), var(--primary-light)); }
  .tl-ico { width: 42px; height: 42px; border-radius: 50%; display: grid; place-items: center; background: var(--surface-2); border: 2px solid var(--border); color: var(--muted); z-index: 2; }
  .tl-step.done .tl-ico { background: var(--primary); border-color: var(--primary); color: #1a0a00; box-shadow: 0 0 18px rgba(255,122,26,0.5); }
  .tl-step.current .tl-ico { background: var(--surface-2); border-color: var(--primary); color: var(--primary-light); box-shadow: 0 0 0 4px rgba(255,122,26,0.15); }
  .tl-step.current .tl-ico::after { content: ""; position: absolute; width: 42px; height: 42px; border-radius: 50%; border: 2px solid var(--primary); animation: tl-ping 1.8s var(--ease) infinite; }
  @keyframes tl-ping { 0% { transform: scale(1); opacity: 0.8; } 100% { transform: scale(1.6); opacity: 0; } }
  .tl-title { font-family: var(--font-display); font-weight: 700; font-size: 15.5px; color: var(--white); }
  .tl-step:not(.done):not(.current) .tl-title { color: var(--muted); }
  .tl-desc { color: var(--muted); font-size: 13.5px; margin-top: 3px; }
  .tl-time { color: var(--muted-2); font-size: 12.5px; margin-top: 5px; font-family: var(--font-num); }
  .tl-step.current .tl-time { color: var(--primary-light); }

  .map-motion { position: relative; height: 340px; border-radius: var(--r-md); overflow: hidden; background: radial-gradient(circle at 30% 30%, rgba(30,61,114,0.35), transparent 60%), var(--secondary); border: 1px solid var(--border); }
  .map-updated { display: flex; align-items: center; gap: 8px; color: var(--muted); font-size: 12.5px; margin-top: 14px; }
  .map-updated .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--success); box-shadow: 0 0 0 3px rgba(74,222,128,0.18); }

  .help-band { padding: 20px 0 90px; }
  .help-box { background: linear-gradient(160deg, var(--surface-2), var(--surface)); border: 1px solid var(--border-strong); border-radius: var(--r-xl); padding: 44px; display: flex; justify-content: space-between; align-items: center; gap: 30px; flex-wrap: wrap; }
  .help-box h3 { font-family: var(--font-display); font-weight: 700; font-size: 24px; color: var(--white); }
  .help-box p { color: var(--muted); margin-top: 8px; max-width: 520px; }
  .help-actions { display: flex; gap: 12px; flex-wrap: wrap; }

  @media (max-width: 900px) {
    .ship-meta { grid-template-columns: repeat(2, 1fr); }
    .ship-grid { grid-template-columns: 1fr; }
  }
  @media (max-width: 560px) {
    .search-form { flex-direction: column; }
    .search-form .btn { justify-content: center; }
    .ship-meta { grid-template-columns: 1fr; }
    .help-box { flex-direction: column; align-items: flex-start; }
  }
</style>
@endpush

@section('content')
<section class="track-hero">
  <div class="track-hero-motion" data-motion="ambient" aria-hidden="true"></div>
  <div class="track-hero-glow"></div>
  <div class="container">
    <span class="eyebrow">{{ __('tracking.hero.eyebrow') }}</span>
    <h1>{{ __('tracking.hero.title_lead') }} <span class="accent">{{ __('tracking.hero.title_accent') }}</span></h1>
    <p>{{ __('tracking.hero.sub') }}</p>
    <form class="search-form" id="trackForm" autocomplete="off">
      <input type="text" class="search-input" id="trackInput" name="tracking" placeholder="{{ __('tracking.hero.placeholder') }}" aria-label="{{ __('tracking.hero.placeholder') }}">
      <button type="submit" class="btn btn-primary">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        {{ __('tracking.hero.cta') }}
      </button>
    </form>
    <div class="track-error" id="trackError"></div>
  </div>
</section>

<section class="track-result" id="result">
  <div class="container">
    <div class="track-empty" id="trackEmpty">
      <div class="track-empty-ico">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
      </div>
      <p>{{ __('tracking.result.empty_prompt') }}</p>
    </div>

    <div class="ship-result" id="shipResult" hidden>
      <div class="ship-card">
        <div class="ship-head">
          <div>
            <div class="label">{{ __('tracking.result.tracking_number') }}</div>
            <div class="ship-number-row">
              <span class="ship-number" id="shipNumber">—</span>
              <button class="copy-btn" id="copyBtn" aria-label="{{ __('tracking.result.copy') }}" title="{{ __('tracking.result.copy') }}">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
              </button>
            </div>
          </div>
          <span class="status-badge st-muted" id="statusBadge"><span class="dot"></span>—</span>
        </div>

        <div class="ship-meta" id="shipMeta"></div>

        <div class="progress-wrap">
          <div class="progress-top"><span>{{ __('tracking.result.progress') }}</span></div>
          <div class="stepper" id="stepper">
            <div class="stepper-rail"><div class="stepper-fill" id="stepperFill"></div></div>
            <div class="stepper-nodes">
              @foreach(['stage_1','stage_2','stage_3','stage_4','stage_5'] as $sg)
              <div class="step-node"><span class="sn-dot"></span><span class="sn-label">{{ __('tracking.'.$sg) }}</span></div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="ship-grid">
        <div class="panel">
          <div class="panel-title">{{ __('tracking.timeline.heading') }}</div>
          <div class="timeline" id="timeline"></div>
        </div>

        <div class="panel">
          <div class="panel-title">{{ __('tracking.result.map_title') }}<div class="panel-sub">{{ __('tracking.result.map_note') }}</div></div>
          <div class="map-motion" data-motion="track" aria-hidden="true"></div>
          <div class="map-updated"><span class="dot"></span><span id="mapUpdated">{{ __('tracking.result.updated') }}</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="help-band">
  <div class="container">
    <div class="help-box reveal">
      <div>
        <h3>{{ __('tracking.help.title') }}</h3>
        <p>{{ __('tracking.help.sub') }}</p>
      </div>
      <div class="help-actions">
        <a href="{{ ($isRtl ? url('/') : url('/en')) }}#contact" class="btn btn-primary">
          {{ __('tracking.help.cta_primary') }}
          <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="{{ ($isRtl ? url('/') : url('/en')) }}#platform" class="btn btn-ghost">{{ __('tracking.help.cta_secondary') }}</a>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  (function () {
    const form = document.getElementById('trackForm');
    const input = document.getElementById('trackInput');
    const result = document.getElementById('result');
    const trackEmpty = document.getElementById('trackEmpty');
    const shipResult = document.getElementById('shipResult');
    const card = document.querySelector('.ship-card');
    const numberEl = document.getElementById('shipNumber');
    const statusBadge = document.getElementById('statusBadge');
    const shipMeta = document.getElementById('shipMeta');
    const timeline = document.getElementById('timeline');
    const stepper = document.getElementById('stepper');
    const stepperFill = document.getElementById('stepperFill');
    const stepNodes = Array.from(document.querySelectorAll('#stepper .step-node'));
    const mapUpdated = document.getElementById('mapUpdated');
    const errorEl = document.getElementById('trackError');

    const LOOKUP = @json(url('/track/lookup'));
    const AR = @json(app()->getLocale() === 'ar');
    const T = {
      created: @json(__('tracking.result.created')),
      eta: @json(__('tracking.result.eta')),
      service: @json(__('tracking.result.service')),
      from: @json(__('tracking.result.from')),
      to: @json(__('tracking.result.to')),
      loading: @json(__('tracking.result.loading')),
      updated: @json(__('tracking.result.updated')),
      empty: @json(__('tracking.timeline_empty')),
      notFound: @json(__('tracking.errors.not_found')),
      generic: @json(__('tracking.errors.generic')),
    };
    // Localize common English status labels for the Arabic UI.
    const STATUS_AR = {
      'pending':'قيد الانتظار','processing':'قيد المعالجة','confirmed':'مؤكّد','on hold':'معلّقة',
      'picked up':'تم الاستلام','picked_up':'تم الاستلام','collected':'تم الاستلام',
      'in transit':'قيد التوصيل','in_transit':'قيد التوصيل','shipped':'تم الشحن',
      'out for delivery':'خرجت للتوصيل','out_for_delivery':'خرجت للتوصيل',
      'delivered':'تم التسليم','cancelled':'ملغاة','canceled':'ملغاة','returned':'مرتجعة','failed':'فشل التسليم'
    };
    const statusLabel = s => { const k = String(s || '').toLowerCase().trim(); return AR ? (STATUS_AR[k] || s || '—') : (s || '—'); };
    const esc = s => String(s == null ? '' : s).replace(/[&<>"']/g, c => ({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[c]));
    const pick = (o, keys) => { for (const k of keys) { if (o && o[k] != null && o[k] !== '') return o[k]; } return null; };
    const fmt = v => { if (v == null || v === '') return ''; const d = new Date(v); if (!isNaN(d.getTime())) { try { return new Intl.DateTimeFormat(AR ? 'ar' : 'en', { dateStyle: 'medium', timeStyle: 'short' }).format(d); } catch (_) { return d.toLocaleString(); } } return String(v); };

    const ICON = {
      clock: '<path d="M12 22a10 10 0 100-20 10 10 0 000 20z"/><path d="M12 6v6l4 2"/>',
      truck: '<path d="M1 3h15v13H1z"/><path d="M16 8h4l3 3v5h-7V8z"/><path d="M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/><path d="M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/>',
      warehouse: '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/>',
      pin: '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><path d="M12 13a3 3 0 100-6 3 3 0 000 6z"/>',
      dot: '<circle cx="12" cy="12" r="3.5"/>',
    };
    const svg = p => `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">${p}</svg>`;

    const badgeKind = s => { const k = String(s || '').toLowerCase(); if (k.includes('deliver') && !k.includes('out')) return 'st-green'; if (k.includes('cancel') || k.includes('fail') || k.includes('return')) return 'st-red'; if (k.includes('pending') || k.includes('hold') || k.includes('process') || k.includes('confirm')) return 'st-muted'; return 'st-orange'; };
    const setBadge = (label, kind) => { statusBadge.className = 'status-badge ' + kind; statusBadge.innerHTML = '<span class="dot"></span>' + esc(label); };
    const showError = m => { if (errorEl) { errorEl.textContent = m; errorEl.classList.add('show'); } };
    const clearError = () => errorEl && errorEl.classList.remove('show');

    const renderMeta = d => {
      const defs = [
        { keys: ['eta','estimated_delivery','expected_delivery','eta_label'], label: T.eta, icon: ICON.clock, fmt: true },
        { keys: ['courier','carrier','service','service_label'], label: T.service, icon: ICON.truck },
        { keys: ['origin','from','origin_label','pickup_city'], label: T.from, icon: ICON.warehouse },
        { keys: ['destination','to','destination_label','recipient_city','city'], label: T.to, icon: ICON.pin },
        { keys: ['created_at','created'], label: T.created, icon: ICON.clock, fmt: true },
      ];
      const items = [];
      for (const def of defs) {
        const raw = pick(d, def.keys);
        if (raw == null) continue;
        const val = def.fmt ? fmt(raw) : String(raw);
        if (!val) continue;
        items.push(`<div class="meta-item"><span class="meta-ico">${svg(def.icon)}</span><div><div class="meta-label">${esc(def.label)}</div><div class="meta-value">${esc(val)}</div></div></div>`);
      }
      shipMeta.innerHTML = items.join('');
      shipMeta.style.display = items.length ? '' : 'none';
    };

    const renderTimeline = d => {
      let ev = Array.isArray(d.events) ? d.events.slice() : [];
      const t = e => { const v = pick(e, ['timestamp','created_at','occurred_at','date','time','datetime']); const p = v ? Date.parse(v) : NaN; return isNaN(p) ? 0 : p; };
      if (ev.some(e => t(e))) ev.sort((a, b) => t(b) - t(a));
      if (!ev.length) ev = [{ status_label: d.status_label, created_at: d.created_at }];
      timeline.innerHTML = ev.map((e, i) => {
        const title = statusLabel(pick(e, ['status_label','status','label','title']) || pick(e, ['description','note']) || '—');
        const desc = pick(e, ['description','note','location_label','location','city','hub','address']);
        const time = fmt(pick(e, ['timestamp','created_at','occurred_at','date','time','datetime']));
        const cls = i === 0 ? 'current' : 'done';
        return `<div class="tl-step ${cls}"><div class="tl-ico">${svg(i === 0 ? ICON.truck : ICON.dot)}</div><div><div class="tl-title">${esc(title)}</div>${desc ? `<div class="tl-desc">${esc(desc)}</div>` : ''}${time ? `<div class="tl-time">${esc(time)}</div>` : ''}</div></div>`;
      }).join('');
    };

    // Numeric parcel status -> 5-step stage. Adjust the right-hand values if Rushly's
    // status codes differ; unknown codes fall back to status_label keyword inference.
    const STATUS_STEPS = { 1: 1, 2: 2, 3: 3, 4: 4, 5: 5 };
    const isFail = s => { const k = String(s || '').toLowerCase(); return k.includes('cancel') || k.includes('fail') || k.includes('return') || k.includes('reject'); };
    const computeStep = d => {
      let step = STATUS_STEPS[d.status];
      if (!step) {
        const k = String(d.status_label || '').toLowerCase();
        if (k.includes('deliver') && !k.includes('out')) step = 5;
        else if (k.includes('out for') || k.includes('delivery')) step = 4;
        else if (k.includes('transit') || k.includes('shipped') || k.includes('on the way') || k.includes('dispatch')) step = 3;
        else if (k.includes('pick') || k.includes('pack') || k.includes('process') || k.includes('confirm') || k.includes('prepar')) step = 2;
        else step = 1; // pending / created / unknown
      }
      return Math.min(5, Math.max(1, step));
    };
    const renderStepper = d => {
      if (!stepper) return;
      const step = computeStep(d);
      const fail = isFail(d.status_label);
      stepper.classList.toggle('is-fail', fail);
      stepNodes.forEach((n, i) => {
        const idx = i + 1;
        n.classList.toggle('done', idx < step);
        n.classList.toggle('current', idx === step);
      });
      const pct = ((step - 1) / 4) * 100;
      stepperFill.style.width = '0%';
      requestAnimationFrame(() => requestAnimationFrame(() => { stepperFill.style.width = pct + '%'; }));
    };

    const render = d => {
      if (d.tracking_id) numberEl.textContent = d.tracking_id;
      setBadge(statusLabel(d.status_label), badgeKind(d.status_label));
      renderMeta(d);
      renderStepper(d);
      renderTimeline(d);
      if (mapUpdated) { const latest = fmt(pick(d, ['updated_at','created_at'])); mapUpdated.textContent = latest || T.updated; }
    };

    const showResult = () => { if (trackEmpty) trackEmpty.hidden = true; if (shipResult) shipResult.hidden = false; };
    const showEmpty = () => { if (shipResult) shipResult.hidden = true; if (trackEmpty) trackEmpty.hidden = false; };

    let busy = false;
    const lookup = async (id) => {
      if (!id || busy) return;
      busy = true;
      clearError();
      showResult();
      if (card) card.classList.add('is-loading');
      setBadge(T.loading, 'st-muted');
      shipMeta.innerHTML = '';
      timeline.innerHTML = `<div class="tl-loading"><span class="tl-spinner"></span>${esc(T.loading)}</div>`;
      try {
        const res = await fetch(`${LOOKUP}/${encodeURIComponent(id)}`, { headers: { 'Accept': 'application/json' } });
        const json = await res.json().catch(() => null);
        if (res.ok && json && json.success && json.data) {
          render(json.data);
        } else {
          showEmpty();
          showError((json && json.message) || (res.status === 404 ? T.notFound : T.generic));
        }
      } catch (_) {
        showEmpty();
        showError(T.generic);
      } finally {
        if (card) card.classList.remove('is-loading');
        busy = false;
      }
    };

    form?.addEventListener('submit', e => {
      e.preventDefault();
      const code = (input.value || '').trim();
      if (!code) { input.focus(); return; }
      numberEl.textContent = code;
      result.scrollIntoView({ behavior: 'smooth', block: 'start' });
      lookup(code);
    });
    document.getElementById('copyBtn')?.addEventListener('click', async () => { try { await navigator.clipboard.writeText(numberEl.textContent.trim()); } catch (_) {} });
  })();
</script>
@endpush

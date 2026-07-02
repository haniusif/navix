@php $isRtl = app()->getLocale() === 'ar'; @endphp
@extends('layouts.site', [
    'navHome' => $isRtl ? url('/') : url('/en'),
    'anchorBase' => $isRtl ? url('/') : url('/en'),
    'switchUrl' => $isRtl ? url('/en/'.$page) : url('/'.$page),
])

@section('title', __('legal.'.$page.'.title') . ' | NAVIX')
@section('description', __('legal.'.$page.'.intro'))

@push('styles')
<style>
  .legal { padding: 160px 0 100px; position: relative; }
  .legal-glow { position: absolute; z-index: 0; top: -140px; inset-inline-end: -120px; width: 560px; height: 560px; border-radius: 50%; background: radial-gradient(circle, rgba(255,122,26,0.12), transparent 65%); pointer-events: none; }
  .legal-container { position: relative; z-index: 2; max-width: 820px; }
  .legal h1 { font-family: var(--font-display); font-weight: 800; font-size: clamp(32px, 4.4vw, 52px); line-height: 1.08; letter-spacing: -0.02em; margin-top: 16px; }
  .legal-updated { color: var(--muted-2); font-size: 14px; margin-top: 12px; font-family: var(--font-num); }
  .legal-intro { color: var(--muted); font-size: 17px; line-height: 1.85; margin-top: 26px; }
  .legal h2 { font-family: var(--font-display); font-weight: 700; font-size: 21px; color: var(--white); margin-top: 40px; margin-bottom: 12px; }
  .legal p { color: var(--muted); font-size: 15.5px; line-height: 1.85; margin-bottom: 14px; }
  .legal-contact { margin-top: 44px; padding-top: 26px; border-top: 1px solid var(--border); color: var(--muted); font-size: 15px; }
  .legal-contact a { color: var(--primary-light); text-decoration: none; }
  .legal-contact a:hover { text-decoration: underline; }
</style>
@endpush

@section('content')
<section class="legal">
  <div class="legal-glow"></div>
  <div class="container legal-container">
    <span class="eyebrow">{{ __('legal.eyebrow') }}</span>
    <h1>{{ __('legal.'.$page.'.title') }}</h1>
    <div class="legal-updated">{{ __('legal.'.$page.'.updated') }}</div>
    <p class="legal-intro">{{ __('legal.'.$page.'.intro') }}</p>

    @foreach(__('legal.'.$page.'.sections') as $section)
      <h2>{{ $section['heading'] }}</h2>
      @foreach($section['body'] as $paragraph)
        <p>{{ $paragraph }}</p>
      @endforeach
    @endforeach

    <p class="legal-contact">
      {!! preg_replace('/info@navix\.com\.sa/', '<a href="mailto:info@navix.com.sa">info@navix.com.sa</a>', e(__('legal.'.$page.'.contact'))) !!}
    </p>
  </div>
</section>
@endsection

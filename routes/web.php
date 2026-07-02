<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    app()->setLocale('ar');
    return view('welcome');
})->name('home');

Route::get('/en', function () {
    app()->setLocale('en');
    return view('welcome');
})->name('home.en');

Route::get('/ar', function () {
    return redirect('/', 301);
});

Route::get('/track', function () {
    app()->setLocale('ar');
    return view('tracking');
})->name('track');

Route::get('/en/track', function () {
    app()->setLocale('en');
    return view('tracking');
})->name('track.en');

// Server-side proxy for the Rushly public tracking API — keeps the X-API-Key off the client.
Route::get('/track/lookup/{trackingId}', function (string $trackingId) {
    $key = config('services.rushly.key');
    if (! $key) {
        return response()->json(['success' => false, 'error' => 'not_configured', 'message' => 'Tracking service is not configured.'], 503);
    }

    try {
        $resp = Http::withHeaders([
            'X-API-Key' => $key,
            'Accept' => 'application/json',
        ])->timeout(15)->get(rtrim(config('services.rushly.base_url'), '/').'/tracking/'.$trackingId);
    } catch (\Throwable $e) {
        return response()->json(['success' => false, 'error' => 'upstream_unreachable', 'message' => 'Could not reach the tracking service.'], 502);
    }

    return response()->json($resp->json() ?? ['success' => false, 'error' => 'invalid_response'], $resp->status());
})->where('trackingId', '[A-Za-z0-9._\-]+')->name('track.lookup');

Route::get('/partners', function () {
    app()->setLocale('ar');
    return view('partners');
})->name('partners');

Route::get('/en/partners', function () {
    app()->setLocale('en');
    return view('partners');
})->name('partners.en');

// Legal pages (Privacy Policy & Terms) — bilingual.
Route::get('/privacy', function () {
    app()->setLocale('ar');
    return view('legal', ['page' => 'privacy']);
})->name('privacy');

Route::get('/en/privacy', function () {
    app()->setLocale('en');
    return view('legal', ['page' => 'privacy']);
})->name('privacy.en');

Route::get('/terms', function () {
    app()->setLocale('ar');
    return view('legal', ['page' => 'terms']);
})->name('terms');

Route::get('/en/terms', function () {
    app()->setLocale('en');
    return view('legal', ['page' => 'terms']);
})->name('terms.en');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

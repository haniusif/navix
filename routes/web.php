<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

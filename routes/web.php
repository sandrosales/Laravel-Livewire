<?php

use App\Livewire\{
    ShowTweet,
};
use Illuminate\Support\Facades\Route;

Route::get('tweets', ShowTweet::class)->middleware(['auth'])->name('tweets');

Route::get('/', function () {
    return view('welcome');
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

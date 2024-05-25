<?php

use App\Livewire\{
    ShowTweet,
};
use App\Livewire\User\UploadPhoto;
use Illuminate\Support\Facades\Route;

Route::get('/upload', UploadPhoto::class)->name('upload.photo.user');
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

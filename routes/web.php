<?php

use App\Livewire\{
    ShowTweet,
};
use Illuminate\Support\Facades\Route;

Route::get('tweets', ShowTweet::class);

Route::get('/', function () {
    return view('welcome');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwenMediaController;
use App\Console\Commands\OwenMediaLatestUsers;
use Illuminate\Support\Facades\Schedule;


Route::get('/', function () {
    return view('welcome');
});

// for testing
Schedule::command(OwenMediaLatestUsers::class)->everyFiveSeconds(); // optional

Route::post('/register', [OwenMediaController::class, 'register'])->name('user.register');
Route::fallback(function () {
    return response()->view('notFound', [], 404);
});

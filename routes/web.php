<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwenMediaController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [OwenMediaController::class, 'register'])->name('user.register');
Route::fallback(function () {
    return response()->view('notFound', [], 404);
});

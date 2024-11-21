<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LinkController;

// Аутентификация
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Ссылки
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/shorten', [LinkController::class, 'shorten']);
    Route::get('/user/links', [LinkController::class, 'userLinks']);
});

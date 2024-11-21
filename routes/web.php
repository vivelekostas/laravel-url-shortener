<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LinkController;

Route::get('/{shortCode}', [LinkController::class, 'redirect']);

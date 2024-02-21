<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarController::class, 'index']) -> name('list');

Route::get('/create', [CarController::class, 'create']) -> name('create');

Route::post('/cars', [CarController::class, 'store']) -> name('store');
<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FuelController;
use Illuminate\Support\Facades\Route;

// 페이지
Route::get('/', [CarController::class, 'index']) -> name('list');
Route::get('/create', [CarController::class, 'create']) -> name('create');
Route::get('/show/{id}', [CarController::class, 'show']) -> name('show');

// api
Route::get('/types', [TypeController::class, 'store']);
Route::get('/brands', [BrandController::class, 'store']);
Route::get('/fuels', [FuelController::class, 'store']);
Route::post('/cars', [CarController::class, 'store']);
Route::get('/cars', [CarController::class, 'showAll']);
Route::post('/upload', [CarController::class, 'upload']);
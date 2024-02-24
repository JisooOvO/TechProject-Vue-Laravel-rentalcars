<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// 페이지
Route::get('/', [CarController::class, 'index']) -> name('list');
Route::get('/create', [CarController::class, 'create']) -> name('create');
Route::get('/show/{id}', [CarController::class, 'show']) -> name('show');
Route::get('/reservation', [CarController::class, 'reservation']) -> name('reservation');

// api
Route::get('/types', [TypeController::class, 'store']);
Route::get('/brands', [BrandController::class, 'store']);
Route::get('/fuels', [FuelController::class, 'store']);
Route::post('/cars', [CarController::class, 'store']);
Route::post('/upload', [CarController::class, 'upload']);
Route::get('/cars', [CarController::class, 'showAll']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get("/reservations", [ReservationController::class, 'update']);
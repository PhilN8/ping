<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services;

Route::get('/', Services\IndexController::class)->name('index');
Route::post('/', Services\StoreController::class)->name('store');
Route::get('/{service}', Services\ShowController::class)->name('show');
Route::patch('/{service}', Services\UpdateController::class)->name('update');
Route::delete('/{service}', Services\DeleteController::class)->name('delete');

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Credentials;

Route::get('/', Credentials\IndexController::class)->name('index');
Route::post('/', Credentials\StoreController::class)->name('store');
Route::get('/{credential}', Credentials\ShowController::class)->name('show');
Route::patch('/{credential}', Credentials\UpdateController::class)->name('update');
Route::delete('/{credential}', Credentials\DeleteController::class)->name('delete');

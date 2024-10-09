<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Checks;

Route::get('/', Checks\IndexController::class)->name('index');
Route::post('/', Checks\StoreController::class)->name('store');
Route::get('/{check}', Checks\ShowController::class)->name('show');
Route::patch('/{check}', Checks\UpdateController::class)->name('update');
Route::delete('/{check}', Checks\DeleteController::class)->name('delete');

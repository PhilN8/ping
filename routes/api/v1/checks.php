<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Checks;
use Illuminate\Support\Facades\Route;

Route::get('/', Checks\IndexController::class)->name('index');
Route::post('/', Checks\StoreController::class)->name('store');
Route::get('/{check}', Checks\ShowController::class)->name('show');
Route::patch('/{check}', Checks\UpdateController::class)->name('update');
Route::delete('/{check}', Checks\DeleteController::class)->name('delete');

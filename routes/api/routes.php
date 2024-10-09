<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', fn(Request $request) => $request->user());

Route::prefix('services')->as('services:')->group(base_path(
    path: 'routes/api/services.php',
));

Route::prefix('credentials')->as('credentials:')->group(base_path(
    path: 'routes/api/credentials.php',
));

Route::prefix('checks')->as('checks:')->group(base_path(
    path: 'routes/api/checks.php',
));

<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api/routes.php',
        apiPrefix: '',
        commands: __DIR__ . '/../routes/console/routes.php',
        health: '/up',
        web: __DIR__ . '/../routes/web/routes.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);


    })
    ->withExceptions(function (Exceptions $exceptions): void {})->create();

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

final class LoginController
{
    public function __invoke(LoginRequest $request): Response
    {
        $request->authenticate();

        /** @var \Laravel\Sanctum\NewAccessToken */
        $token = auth()?->user()?->createToken(
            name: 'api-auth'
        );

        return new JsonResponse(
            data: [
                'token' => $token->plainTextToken,
            ]
        );
    }
}
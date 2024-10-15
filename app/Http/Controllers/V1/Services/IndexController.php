<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Enums\CacheKey;
use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

final class IndexController
{
    public function __invoke(Request $request): Response
    {
        // Cache all services for the current user
        Cache::forever(
            key: CacheKey::USER_SERVICES->value . "_" . Auth::id(),
            value: $cachedServices = Service::query()->where(
                column: 'user_id',
                operator: '=',
                value: Auth::id(),
            )->pluck('id')->toArray(),
        );

        $services = QueryBuilder::for(
            subject: Service::query()->whereIn(
                column: 'id',
                values: $cachedServices,
            ),
        )->allowedIncludes(
            includes: [
                'checks',
            ],
        )->getEloquentBuilder()->simplePaginate(
            perPage: config('app.pagination.limit'),
        );

        // return new JsonResponse(
        //     data: ServiceResource::collection(
        //         resource: $services,
        //     ),
        // );

        return ServiceResource::collection(
            resource: $services,
        )->toResponse(
            request: $request
        );
    }
}

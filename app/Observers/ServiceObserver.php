<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\CacheKey;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

final class ServiceObserver
{
    public function created(Service $service): void
    {
        $this->forgetServicesForever(
            id: $service->user_id,
        );
    }

    public function updated(Service $service): void
    {
        $this->forgetServicesForever(
            id: $service->user_id,
        );

        $this->forgetService(
            id: $service->user_id,
        );
    }

    public function deleted(Service $service): void
    {
        $this->forgetServicesForever(
            id: $service->user_id,
        );

        $this->forgetService(
            id: $service->user_id,
        );
    }

    private function forgetServicesForever(string $id): void
    {
        Cache::forget(
            CacheKey::USER_SERVICES->value . "_" . $id,
        );
    }

    private function forgetService(string $id): void
    {
        Cache::forget(
            CacheKey::SERVICE->value . "_" . $id,
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Enums;

enum CacheKey: string
{
    case USER_SERVICES = 'user-services';
    case SERVICE = 'service';
}

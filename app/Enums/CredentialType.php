<?php

declare(strict_types=1);

namespace App\Enums;

enum CredentialType: string
{
    case BEARER_AUTH = "Bearer-Auth";
    case BASIC_AUTH = "Basic-Auth";
    case DIGEST_AUTH = "Digest-Auth";
}

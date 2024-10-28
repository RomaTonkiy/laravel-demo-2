<?php

namespace Modules\Auth\DTO;

use Spatie\LaravelData\Data;

class AuthDataDTO extends Data
{
    public function __construct(
        public string $tokenType,
        public int $expiresIn,
        public string $accessToken,
        public string $refreshToken,
    )
    {
    }
}

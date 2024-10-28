<?php

declare(strict_types=1);

namespace App\Enums\Messages;

enum AuthorizationMessageEnum: string
{
    public const UNAUTHORIZED = 'Unauthorized';
    public const AUTHORIZED = 'Authorized';
    public const NO_PERMISSION = 'No permission';
}

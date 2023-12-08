<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * Helpers.
 */
final readonly class UidHelper
{
    /**
     * Generate a new unique identifier (UID) such as UUID and ULID.
     */
    public function generate(): string
    {
        return mb_strtolower(string: (string) Str::ulid());
    }
}

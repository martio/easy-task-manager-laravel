<?php

declare(strict_types=1);

namespace App\Enums\Concerns;

use BackedEnum;

trait Equalable
{
    /**
     * Determine if this instance is equal to the given enum instance.
     */
    public function equals(BackedEnum $enum): bool
    {
        return $this === $enum;
    }
}

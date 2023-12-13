<?php

declare(strict_types=1);

namespace App\Commands\User;

final readonly class ImportUserCommand
{
    /**
     * Create a new command instance.
     */
    public function __construct(
        public string $externalId,
    ) {
    }
}

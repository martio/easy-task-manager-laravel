<?php

declare(strict_types=1);

namespace App\Commands\User;

final readonly class CreateUserCommand
{
    /**
     * Create a new command instance.
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }
}

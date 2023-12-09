<?php

declare(strict_types=1);

namespace App\Events\User;

use Illuminate\Foundation\Events\Dispatchable;

final readonly class UserCreatedEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public string $userId,
    ) {
    }
}

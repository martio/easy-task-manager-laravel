<?php

declare(strict_types=1);

namespace App\Events\Task;

use Illuminate\Foundation\Events\Dispatchable;

final readonly class TaskDeletedEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public string $taskId,
    ) {
    }
}

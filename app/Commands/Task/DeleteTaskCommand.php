<?php

declare(strict_types=1);

namespace App\Commands\Task;

final readonly class DeleteTaskCommand
{
    /**
     * Create a new command instance.
     */
    public function __construct(
        public string $taskId,
    ) {
    }
}

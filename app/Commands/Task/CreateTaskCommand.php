<?php

declare(strict_types=1);

namespace App\Commands\Task;

final readonly class CreateTaskCommand
{
    /**
     * Create a new command instance.
     */
    public function __construct(
        public string $userId,
        public string $title,
        public string $description,
    ) {
    }
}

<?php

declare(strict_types=1);

namespace App\Commands\Task;

use App\Enums\Task\StatusEnum;

final readonly class UpdateTaskCommand
{
    /**
     * Update a new command instance.
     */
    public function __construct(
        public string $taskId,
        public string $userId,
        public string $title,
        public string $description,
        public StatusEnum $status,
    ) {
    }
}

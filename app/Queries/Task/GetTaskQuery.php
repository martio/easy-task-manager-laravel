<?php

declare(strict_types=1);

namespace App\Queries\Task;

final readonly class GetTaskQuery
{
    /**
     * Create a new query instance.
     */
    public function __construct(
        public string $taskId,
    ) {
    }
}

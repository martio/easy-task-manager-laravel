<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\Task\StatusEnum;

interface TaskRepository
{
    /**
     * Create a new task.
     */
    public function create(
        string $id,
        string $userId,
        string $title,
        string $description,
        StatusEnum $status,
    ): void;
}

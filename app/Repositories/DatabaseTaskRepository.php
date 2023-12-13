<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\Task\StatusEnum;
use App\Models\Task;

final readonly class DatabaseTaskRepository implements TaskRepository
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
    ): void {
        Task::query()->create(attributes: [
            'id' => $id,
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'status' => $status->state(),
        ]);
    }
}

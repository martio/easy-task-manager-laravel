<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\DataCollection;
use App\Data\Task\TaskData;
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

    /**
     * Get the task by the given id.
     */
    public function get(string $id): TaskData;

    /**
     * Get the all tasks.
     *
     * @return DataCollection<TaskData>
     */
    public function getAll(): DataCollection;

    /**
     * Update the task by the given id.
     */
    public function update(
        string $id,
        string $userId,
        string $title,
        string $description,
        StatusEnum $status,
    ): void;

    /**
     * Delete the task by the given id.
     */
    public function delete(string $id): void;
}

<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\DataCollection;
use App\Data\Task\TaskData;
use App\Enums\Task\StatusEnum;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Task;
use App\States\Task\TaskState;
use Illuminate\Support\Facades\DB;

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

    /**
     * Get the task by the given id.
     */
    public function get(string $id): TaskData
    {
        $model = Task::query()->find(id: $id);

        if (is_null(value: $model)) {
            throw new ResourceNotFoundException(type: 'task', column: 'id', value: $id);
        }

        return TaskData::fromModel(model: $model);
    }

    /**
     * Get the all tasks.
     *
     * @return DataCollection<TaskData>
     */
    public function getAll(): DataCollection
    {
        $models = Task::query()->get()->all();

        return TaskData::collection(items: $models);
    }

    /**
     * Update the task by the given id.
     */
    public function update(
        string $id,
        string $userId,
        string $title,
        string $description,
        StatusEnum $status,
    ): void {
        $model = Task::query()->find(id: $id);

        if (is_null(value: $model)) {
            throw new ResourceNotFoundException(type: 'task', column: 'id', value: $id);
        }

        DB::transaction(callback: function () use (
            $model,
            $userId,
            $title,
            $description,
            $status,
        ): void {
            $model->update(attributes: [
                'user_id' => $userId,
                'title' => $title,
                'description' => $description,
            ]);

            /** @var TaskState $currentStatus */
            $currentStatus = $model->status;

            if ($currentStatus->canTransitionTo(newState: $status->state())) {
                $currentStatus->transitionTo(newState: $status->state());
            }
        });
    }

    /**
     * Delete the task by the given id.
     */
    public function delete(string $id): void
    {
        $model = Task::query()->find(id: $id);

        if (is_null(value: $model)) {
            throw new ResourceNotFoundException(type: 'task', column: 'id', value: $id);
        }

        $model->delete();
    }
}

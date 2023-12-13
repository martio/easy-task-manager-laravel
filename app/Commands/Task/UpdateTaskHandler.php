<?php

declare(strict_types=1);

namespace App\Commands\Task;

use App\Events\Task\TaskUpdatedEvent;
use App\Repositories\TaskRepository;

final readonly class UpdateTaskHandler
{
    /**
     * Update a new command handler instance.
     */
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    /**
     * Execute the action.
     */
    public function __invoke(UpdateTaskCommand $command): void
    {
        $this->taskRepository->update(
            id: $command->taskId,
            userId: $command->userId,
            title: $command->title,
            description: $command->description,
            status: $command->status,
        );

        event(new TaskUpdatedEvent(
            taskId: $command->taskId,
        ));
    }
}

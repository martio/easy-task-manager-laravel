<?php

declare(strict_types=1);

namespace App\Commands\Task;

use App\Events\Task\TaskDeletedEvent;
use App\Repositories\TaskRepository;

final readonly class DeleteTaskHandler
{
    /**
     * Delete a new command handler instance.
     */
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    /**
     * Execute the action.
     */
    public function __invoke(DeleteTaskCommand $command): void
    {
        $this->taskRepository->delete(
            id: $command->taskId,
        );

        event(new TaskDeletedEvent(
            taskId: $command->taskId,
        ));
    }
}

<?php

declare(strict_types=1);

namespace App\Queries\Task;

use App\Data\Task\TaskData;
use App\Repositories\TaskRepository;

final readonly class GetTaskHandler
{
    /**
     * Delete a new command handler instance.
     */
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    /**
     * Execute the query.
     */
    public function __invoke(GetTaskQuery $command): TaskData
    {
        return $this->taskRepository->get(
            id: $command->taskId,
        );
    }
}

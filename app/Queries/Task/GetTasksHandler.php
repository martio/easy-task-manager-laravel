<?php

declare(strict_types=1);

namespace App\Queries\Task;

use App\Data\DataCollection;
use App\Data\Task\TaskData;
use App\Repositories\TaskRepository;

final readonly class GetTasksHandler
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
     *
     * @return DataCollection<TaskData>
     */
    public function __invoke(GetTasksQuery $command): DataCollection
    {
        return $this->taskRepository->getAll();
    }
}

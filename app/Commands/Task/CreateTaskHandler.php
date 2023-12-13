<?php

declare(strict_types=1);

namespace App\Commands\Task;

use App\Enums\Task\StatusEnum;
use App\Events\Task\TaskCreatedEvent;
use App\Helpers\Facades\Uid;
use App\Repositories\TaskRepository;

final readonly class CreateTaskHandler
{
    /**
     * Create a new command handler instance.
     */
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    /**
     * Execute the action.
     */
    public function __invoke(CreateTaskCommand $command): string
    {
        $taskId = Uid::generate();

        $this->taskRepository->create(
            id: $taskId,
            userId: $command->userId,
            title: $command->title,
            description: $command->description,
            status: StatusEnum::Pending,
        );

        event(new TaskCreatedEvent(
            taskId: $taskId,
        ));

        return $taskId;
    }
}

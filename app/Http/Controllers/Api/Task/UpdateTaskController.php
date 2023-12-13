<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Commands\Task\UpdateTaskCommand;
use App\Commands\Task\UpdateTaskHandler;
use App\Enums\Task\StatusEnum;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

final class UpdateTaskController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly UpdateTaskHandler $updateTaskHandler,
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @throws AuthorizationException
     */
    public function __invoke(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize(ability: 'update', arguments: $task);

        ($this->updateTaskHandler)(
            command: new UpdateTaskCommand(
                taskId: $task->id,
                userId: $request->string(key: 'user_id')->value(),
                title: $request->string(key: 'title')->value(),
                description: $request->string(key: 'description')->value(),
                status: StatusEnum::from(value: $request->string(key: 'status')->value()),
            ),
        );

        return response()->json(data: [
            'status' => 'success',
        ]);
    }
}

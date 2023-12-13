<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Commands\Task\CreateTaskCommand;
use App\Commands\Task\CreateTaskHandler;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateTaskController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly CreateTaskHandler $createTaskHandler,
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @throws AuthorizationException
     */
    public function __invoke(CreateTaskRequest $request): JsonResponse
    {
        $this->authorize(ability: 'create', arguments: Task::class);

        $taskId = ($this->createTaskHandler)(
            command: new CreateTaskCommand(
                userId: $request->string(key: 'user_id')->value(),
                title: $request->string(key: 'title')->value(),
                description: $request->string(key: 'description')->value(),
            ),
        );

        return response()->json(data: [
            'status' => 'success',
            'data' => [
                'id' => $taskId,
            ],
        ], status: Response::HTTP_CREATED);
    }
}

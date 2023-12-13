<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\Controller;
use App\Models\Task;
use App\Queries\Task\GetTaskHandler;
use App\Queries\Task\GetTaskQuery;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

final class GetTaskController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly GetTaskHandler $getTaskHandler,
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @throws AuthorizationException
     */
    public function __invoke(Task $task): JsonResponse
    {
        $this->authorize(ability: 'view', arguments: $task);

        $result = ($this->getTaskHandler)(
            command: new GetTaskQuery(
                taskId: $task->id,
            ),
        );

        return response()->json(data: [
            'status' => 'success',
            'data' => $result,
        ]);
    }
}

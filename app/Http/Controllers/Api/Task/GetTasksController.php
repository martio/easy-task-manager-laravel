<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\Controller;
use App\Models\Task;
use App\Queries\Task\GetTasksHandler;
use App\Queries\Task\GetTasksQuery;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

final class GetTasksController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly GetTasksHandler $getTasksHandler,
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @throws AuthorizationException
     */
    public function __invoke(): JsonResponse
    {
        $this->authorize(ability: 'viewAny', arguments: Task::class);

        $result = ($this->getTasksHandler)(
            command: new GetTasksQuery(),
        );

        return response()->json(data: [
            'status' => 'success',
            'data' => $result,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\Controller;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

final class GetTaskController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
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

        return response()->json(data: [
            'status' => 'success',
            'data' => [],
        ]);
    }
}

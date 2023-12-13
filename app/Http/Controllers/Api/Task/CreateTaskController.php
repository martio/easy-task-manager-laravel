<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

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

        return response()->json(data: [
            'status' => 'success',
            'data' => [],
        ], status: Response::HTTP_CREATED);
    }
}

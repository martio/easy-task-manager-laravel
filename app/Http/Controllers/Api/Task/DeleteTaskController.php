<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\Controller;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DeleteTaskController extends Controller
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
        $this->authorize(ability: 'delete', arguments: $task);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}

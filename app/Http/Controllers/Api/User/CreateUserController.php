<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Commands\User\CreateUserCommand;
use App\Commands\User\CreateUserHandler;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateUserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly CreateUserHandler $createUserHandler,
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        $userId = ($this->createUserHandler)(
            command: new CreateUserCommand(
                name: $request->string(key: 'name')->value(),
                email: $request->string(key: 'email')->value(),
                password: $request->string(key: 'password')->value(),
            ),
        );

        return response()->json(data: [
            'status' => 'success',
            'data' => [
                'id' => $userId,
            ],
        ], status: Response::HTTP_CREATED);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Auth\AuthenticateUserRequest;
use App\Services\User\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AuthenticateUserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly AuthenticationService $authenticationService,
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(AuthenticateUserRequest $request): JsonResponse
    {
        // Simple login feature for REST API.
        // Quickly created for testing purposes, not part of the main test task.

        $result = $this->authenticationService->loginUser(
            email: $request->string(key: 'email')->value(),
            password: $request->string(key: 'password')->value(),
            device: $request->string(key: 'device', default: 'default')->value(),
        );

        $status = $result['status'] === 'success' ? Response::HTTP_OK : Response::HTTP_UNAUTHORIZED;

        return response()->json(data: $result, status: $status);
    }
}

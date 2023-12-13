<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final readonly class AuthenticationService
{
    /**
     * Create a new service instance.
     */
    public function __construct()
    {
    }

    /**
     * Login user.
     */
    public function loginUser(string $email, string $password, string $device): array
    {
        // Quickly created for testing purposes, not part of the main test task.

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if ( ! Auth::attempt(credentials: $credentials)) {
            return [
                'status' => 'failure',
                'message' => 'incorrect-credentials',
            ];
        }

        $user = User::where(column: 'email', operator: '=', value: $email)->firstOrFail();
        $token = $user->createToken(name: $device)->plainTextToken;

        return [
            'status' => 'success',
            'data' => [
                'token' => $token,
            ],
        ];
    }
}

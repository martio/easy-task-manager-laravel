<?php

use App\Http\Controllers\Api\User\CreateUserController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('api.')->group(callback: static function (): void {
    Route::prefix('v1')->group(callback: static function (): void {
        // Simple login function for REST API.
        // Quickly created for testing purposes, not part of the main test task.
        Route::post(uri: '/auth/login', action: function (Request $request): JsonResponse {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ( ! Auth::attempt($credentials)) {
                return response()->json([
                    'status' => 'failure',
                    'message' => 'incorrect-credentials',
                ], 401);
            }

            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken($request->string('device', 'default')->value())->plainTextToken;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'token' => $token,
                ],
            ]);

        })->name(name: 'authentication.login');

        Route::post(uri: '/users', action: CreateUserController::class)->name(name: 'users.create');
    });
});

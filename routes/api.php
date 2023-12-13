<?php

use App\Http\Controllers\Api\Auth\AuthenticateUserController;
use App\Http\Controllers\Api\User\CreateUserController;
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
        Route::post(uri: '/auth/login', action: AuthenticateUserController::class)->name(name: 'authentication.login');
        Route::post(uri: '/users', action: CreateUserController::class)->name(name: 'users.create');
    });
});

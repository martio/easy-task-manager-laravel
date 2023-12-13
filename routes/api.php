<?php

use App\Http\Controllers\Api\Auth\AuthenticateUserController;
use App\Http\Controllers\Api\Task\CreateTaskController;
use App\Http\Controllers\Api\Task\DeleteTaskController;
use App\Http\Controllers\Api\Task\GetTaskController;
use App\Http\Controllers\Api\Task\GetTasksController;
use App\Http\Controllers\Api\Task\UpdateTaskController;
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

        Route::middleware(['auth:sanctum', 'verified'])->group(callback: static function (): void {
            Route::post(uri: '/tasks', action: CreateTaskController::class)->name(name: 'tasks.create');
            Route::get(uri: '/tasks', action: GetTasksController::class)->name(name: 'tasks.index');
            Route::get(uri: '/tasks/{task}', action: GetTaskController::class)->name(name: 'tasks.show')->whereUlid(parameters: 'task');
            Route::put(uri: '/tasks/{task}', action: UpdateTaskController::class)->name(name: 'tasks.update')->whereUlid(parameters: 'task');
            Route::delete(uri: '/tasks/{task}', action: DeleteTaskController::class)->name(name: 'tasks.delete')->whereUlid(parameters: 'task');
        });
    });
});

<?php

declare(strict_types=1);

namespace App\Providers;

use App\Helpers\UidHelper;
use App\Repositories\DatabaseTaskRepository;
use App\Repositories\DatabaseUserRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Services\User\DummyAPIUserImporterService;
use App\Services\User\UserImporterService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(abstract: 'uid', concrete: UidHelper::class);

        $this->app->bind(
            abstract: UserImporterService::class,
            concrete: DummyAPIUserImporterService::class,
        );

        $this->app->bind(abstract: UserRepository::class, concrete: DatabaseUserRepository::class);
        $this->app->bind(abstract: TaskRepository::class, concrete: DatabaseTaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict();
    }
}

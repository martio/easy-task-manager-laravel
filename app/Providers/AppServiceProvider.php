<?php

declare(strict_types=1);

namespace App\Providers;

use App\Helpers\UidHelper;
use App\Repositories\DatabaseUserRepository;
use App\Repositories\UserRepository;
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

        $this->app->bind(abstract: UserRepository::class, concrete: DatabaseUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict();
    }
}

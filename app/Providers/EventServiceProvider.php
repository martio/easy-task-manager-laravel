<?php

namespace App\Providers;

use App\Events\Task\TaskCreatedEvent;
use App\Events\Task\TaskDeletedEvent;
use App\Events\Task\TaskUpdatedEvent;
use App\Events\User\UserCreatedEvent;
use App\Events\User\UserImportedEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserCreatedEvent::class => [
        ],
        UserImportedEvent::class => [
        ],
        TaskCreatedEvent::class => [
        ],
        TaskUpdatedEvent::class => [
        ],
        TaskDeletedEvent::class => [
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

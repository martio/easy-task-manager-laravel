<?php

namespace Tests\Unit\Commands\Task;

use App\Commands\Task\CreateTaskCommand;
use App\Commands\Task\CreateTaskHandler;
use App\Events\Task\TaskCreatedEvent;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(closure: function (): void {
    $this->handler = $this->app->make(abstract: CreateTaskHandler::class);
});

it(description: 'successfully executes the command handler', closure: function (): void {
    Event::fake(eventsToFake: [
        TaskCreatedEvent::class,
    ]);

    $user = User::factory()
        ->createQuietly();

    $result = ($this->handler)(
        command: new CreateTaskCommand(
            userId: $user->id,
            title: 'Lorem ipsum dolor sit amet',
            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
        ),
    );

    expect(value: $result)
        ->toBeString();

    Event::assertDispatched(event: TaskCreatedEvent::class);
});

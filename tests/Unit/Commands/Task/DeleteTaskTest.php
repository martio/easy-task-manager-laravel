<?php

namespace Tests\Unit\Commands\Task;

use App\Commands\Task\DeleteTaskCommand;
use App\Commands\Task\DeleteTaskHandler;
use App\Events\Task\TaskDeletedEvent;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(closure: function (): void {
    $this->handler = $this->app->make(abstract: DeleteTaskHandler::class);
});

it(description: 'successfully executes the command handler', closure: function (): void {
    Event::fake(eventsToFake: [
        TaskDeletedEvent::class,
    ]);

    $user = User::factory()
        ->createQuietly();

    $task = Task::factory()
        ->for(factory: $user)
        ->createQuietly();

    $result = ($this->handler)(
        command: new DeleteTaskCommand(
            taskId: $task->id,
        ),
    );

    expect(value: $result)
        ->toBeNull();

    $this->assertDatabaseCount(table: 'tasks', count: 0);

    Event::assertDispatched(
        event: fn (TaskDeletedEvent $event): bool => $event->taskId === $task->id,
    );
});

it(description: 'unsuccessfully executes the command handler due to non-existent tasks', closure: function (): void {
    ($this->handler)(
        command: new DeleteTaskCommand(
            taskId: 'test',
        ),
    );
})->throws(exception: ResourceNotFoundException::class);

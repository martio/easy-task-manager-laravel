<?php

namespace Tests\Unit\Commands\Task;

use App\Commands\Task\UpdateTaskCommand;
use App\Commands\Task\UpdateTaskHandler;
use App\Enums\Task\StatusEnum;
use App\Events\Task\TaskUpdatedEvent;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(closure: function (): void {
    $this->handler = $this->app->make(abstract: UpdateTaskHandler::class);
});

it(description: 'successfully executes the command handler', closure: function (): void {
    Event::fake(eventsToFake: [
        TaskUpdatedEvent::class,
    ]);

    $user = User::factory()
        ->createQuietly();

    $task = Task::factory()
        ->for(factory: $user)
        ->inProgress()
        ->createQuietly();

    $result = ($this->handler)(
        command: new UpdateTaskCommand(
            taskId: $task->id,
            userId: $user->id,
            title: 'Lorem ipsum dolor sit amet',
            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            status: StatusEnum::Completed,
        ),
    );

    $task->refresh();

    expect(value: $result)
        ->toBeNull()
        ->and(value: $task->status->getValue())
        ->toBe(expected: StatusEnum::Completed->state());

    $this->assertDatabaseCount(table: 'tasks', count: 1);
    $this->assertDatabaseHas(table: 'tasks', data: [
        'id' => $task->id,
        'user_id' => $user->id,
        'title' => 'Lorem ipsum dolor sit amet',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
        'status' => StatusEnum::Completed->state(),
    ]);

    Event::assertDispatched(
        event: fn (TaskUpdatedEvent $event): bool => $event->taskId === $task->id,
    );
});

it(description: 'unsuccessfully executes the command handler due to non-existent tasks', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    ($this->handler)(
        command: new UpdateTaskCommand(
            taskId: 'test',
            userId: $user->id,
            title: 'Lorem ipsum dolor sit amet',
            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            status: StatusEnum::Completed,
        ),
    );
})->throws(exception: ResourceNotFoundException::class);

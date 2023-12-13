<?php

namespace Tests\Feature\Task;

use App\Enums\Task\StatusEnum;
use App\Events\Task\TaskUpdatedEvent;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Event;

it(description: 'returns a successful response', closure: function (): void {
    Event::fake(eventsToFake: [
        TaskUpdatedEvent::class,
    ]);

    $user = User::factory()
        ->createQuietly();

    $task = Task::factory()
        ->for(factory: $user)
        ->inProgress()
        ->createQuietly();

    actingAs(user: $user);

    $response = $this->putJson(
        uri: route(name: 'api.tasks.update', parameters: [
            'task' => $task->id,
        ]),
        data: [
            'user_id' => $user->id,
            'title' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'status' => StatusEnum::Completed,
        ],
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveJsonContent();

    Event::assertDispatched(
        event: fn (TaskUpdatedEvent $event): bool => $event->taskId === $task->id,
    );
});

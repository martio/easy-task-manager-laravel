<?php

namespace Tests\Feature\Task;

use App\Events\Task\TaskDeletedEvent;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Event;

it(description: 'returns a successful response', closure: function (): void {
    Event::fake(eventsToFake: [
        TaskDeletedEvent::class,
    ]);

    $user = User::factory()
        ->createQuietly();

    $task = Task::factory()
        ->for(factory: $user)
        ->createQuietly();

    actingAs(user: $user);

    $response = $this->deleteJson(
        uri: route(name: 'api.tasks.delete', parameters: [
            'task' => $task->id,
        ]),
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveStatus(expected: 204);

    Event::assertDispatched(event: TaskDeletedEvent::class);
});

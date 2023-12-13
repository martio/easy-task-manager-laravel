<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;

it(description: 'returns a successful response', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    $task = Task::factory()
        ->for(factory: $user)
        ->createQuietly();

    actingAs(user: $user);

    $response = $this->getJson(
        uri: route(name: 'api.tasks.show', parameters: [
            'task' => $task->id,
        ]),
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveJsonContent();
});

it(description: 'returns a failure response', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    actingAs(user: $user);

    $response = $this->getJson(
        uri: route(name: 'api.tasks.show', parameters: [
            'task' => 'test',
        ]),
    );

    expect(value: $response)
        ->toBeResponsable()
        ->not()->toBeSuccessful()
        ->toHaveStatus(expected: 404);
});

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
        uri: route(name: 'api.tasks.index'),
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveJsonContent();
});

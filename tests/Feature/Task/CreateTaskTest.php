<?php

namespace Tests\Feature\Task;

use App\Models\User;

it(description: 'returns a successful response', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    actingAs(user: $user);

    $response = $this->postJson(
        uri: route(name: 'api.tasks.create'),
        data: [
            'user_id' => $user->id,
            'title' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
        ],
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveJsonContent();
});

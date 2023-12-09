<?php

namespace Tests\Feature\User;

use App\Events\User\UserCreatedEvent;
use Illuminate\Support\Facades\Event;

it(description: 'returns a successful response', closure: function (): void {
    Event::fake(eventsToFake: [
        UserCreatedEvent::class,
    ]);

    $response = $this->postJson(
        uri: route(name: 'api.users.create'),
        data: [
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => 'P@$$WoRD123',
        ],
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveJsonContent();

    Event::assertDispatched(event: UserCreatedEvent::class);
});

it(description: 'returns a failure response for invalid data', closure: function (): void {
    Event::fake(eventsToFake: [
        UserCreatedEvent::class,
    ]);

    $response = $this->postJson(
        uri: route(name: 'api.users.create'),
        data: [
            'name' => '',
            'email' => '',
            'password' => 'short',
        ],
    );

    expect(value: $response)
        ->toBeResponsable()
        ->not()->toBeSuccessful()
        ->toHaveStatus(expected: 422)
        ->toHaveJsonContent();

    Event::assertNotDispatched(event: UserCreatedEvent::class);
});

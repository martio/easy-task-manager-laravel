<?php

namespace Tests\Unit\Commands\User;

use App\Commands\User\CreateUserCommand;
use App\Commands\User\CreateUserHandler;
use App\Events\User\UserCreatedEvent;
use Illuminate\Support\Facades\Event;

beforeEach(closure: function (): void {
    $this->handler = $this->app->make(abstract: CreateUserHandler::class);
});

it(description: 'successfully executes the command handler', closure: function (): void {
    Event::fake(eventsToFake: [
        UserCreatedEvent::class,
    ]);

    $result = ($this->handler)(
        command: new CreateUserCommand(
            name: 'user',
            email: 'user@example.com',
            password: 'P@$$WoRD123',
        ),
    );

    expect(value: $result)
        ->toBeString();

    $this->assertDatabaseCount(table: 'users', count: 1);
    $this->assertDatabaseHas(table: 'users', data: [
        'name' => 'user',
        'email' => 'user@example.com',
    ]);

    Event::assertDispatched(event: UserCreatedEvent::class);
});

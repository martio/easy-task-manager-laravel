<?php

namespace Tests\Unit\Commands\User;

use App\Commands\User\ImportUserCommand;
use App\Commands\User\ImportUserHandler;
use App\Events\User\UserImportedEvent;
use App\Services\User\TestUserImporterService;
use App\Services\User\UserImporterService;
use Illuminate\Support\Facades\Event;

beforeEach(closure: function (): void {
    $this->instance(
        abstract: UserImporterService::class,
        instance: $this->app->make(abstract: TestUserImporterService::class),
    );

    $this->handler = $this->app->make(abstract: ImportUserHandler::class);
});

it(description: 'successfully executes the command handler', closure: function (): void {
    Event::fake(eventsToFake: [
        UserImportedEvent::class,
    ]);

    $result = ($this->handler)(
        command: new ImportUserCommand(
            externalId: 'test',
        ),
    );

    expect(value: $result)
        ->toBeString();

    $this->assertDatabaseCount(table: 'users', count: 1);
    $this->assertDatabaseHas(table: 'users', data: [
        'name' => 'Test',
        'email' => 'test@dummy.com',
        'external_id' => 'test',
    ]);

    Event::assertDispatched(event: UserImportedEvent::class);
});

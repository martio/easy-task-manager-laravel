<?php

namespace Tests\Unit\Queries\Task;

use App\Data\DataCollection;
use App\Models\Task;
use App\Models\User;
use App\Queries\Task\GetTasksHandler;
use App\Queries\Task\GetTasksQuery;

beforeEach(closure: function (): void {
    $this->handler = $this->app->make(abstract: GetTasksHandler::class);
});

it(description: 'successfully executes the query handler', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    $tasks = Task::factory()
        ->for(factory: $user)
        ->count(count: 3)
        ->createQuietly();

    $result = ($this->handler)(
        command: new GetTasksQuery(),
    );

    expect(value: $result)
        ->toBeInstanceOf(class: DataCollection::class)
        ->and($result->count())
        ->toBe(expected: $tasks->count());
});

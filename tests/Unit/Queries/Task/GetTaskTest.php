<?php

namespace Tests\Unit\Queries\Task;

use App\Data\Task\TaskData;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Task;
use App\Models\User;
use App\Queries\Task\GetTaskHandler;
use App\Queries\Task\GetTaskQuery;

beforeEach(closure: function (): void {
    $this->handler = $this->app->make(abstract: GetTaskHandler::class);
});

it(description: 'successfully executes the query handler', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    $task = Task::factory()
        ->for(factory: $user)
        ->createQuietly();

    $result = ($this->handler)(
        command: new GetTaskQuery(
            taskId: $task->id,
        ),
    );

    expect(value: $result)
        ->toBeInstanceOf(class: TaskData::class)
        ->and(value: $result->id)
        ->toBe(expected: $task->id);
});

it(description: 'unsuccessfully executes the query handler due to non-existent tasks', closure: function (): void {
    ($this->handler)(
        command: new GetTaskQuery(
            taskId: 'test',
        ),
    );
})->throws(exception: ResourceNotFoundException::class);

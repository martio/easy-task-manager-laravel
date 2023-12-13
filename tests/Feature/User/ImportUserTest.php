<?php

namespace Tests\Feature\User;

use App\Jobs\ImportUserJob;
use Illuminate\Support\Facades\Bus;

it(description: 'returns a successful response', closure: function (): void {
    Bus::fake(jobsToFake: [
        ImportUserJob::class,
    ]);

    $response = $this->postJson(
        uri: route(name: 'api.users.import'),
        data: [
            'external_id' => 'test',
        ],
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveStatus(expected: 202);

    Bus::assertDispatched(command: ImportUserJob::class);
});

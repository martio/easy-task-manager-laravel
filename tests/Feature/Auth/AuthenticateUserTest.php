<?php

namespace Tests\Feature\Auth;

use App\Models\User;

it(description: 'returns a successful response', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    $response = $this->postJson(
        uri: route(name: 'api.authentication.login'),
        data: [
            'email' => $user->email,
            'password' => '123Pass&Word321',
            'device' => 'test',
        ],
    );

    expect(value: $response)
        ->toBeResponsable()
        ->toBeSuccessful()
        ->toHaveJsonContent();
});

it(description: 'returns a failure response for unsuccessful user authentication', closure: function (): void {
    $user = User::factory()
        ->createQuietly();

    $response = $this->postJson(
        uri: route(name: 'api.authentication.login'),
        data: [
            'email' => $user->email,
            'password' => 'password',
            'device' => 'test',
        ],
    );

    expect(value: $response)
        ->toBeResponsable()
        ->not()->toBeSuccessful()
        ->toHaveStatus(expected: 401)
        ->toHaveJsonContent();
});

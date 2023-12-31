<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use Pest\Expectation;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// Uses the given test case and traits in the current folder recursively
uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

// Feature
expect()->extend(name: 'toBeResponsable', extend: function (): Expectation {
    $this->toBeInstanceOf(class: TestResponse::class);

    return $this;
});

expect()->extend(name: 'toBeSuccessful', extend: function (): Expectation {
    $this->isSuccessful()->toBeTrue();

    return $this;
});

expect()->extend(name: 'toHaveStatus', extend: function (int $expected): Expectation {
    $this->getStatusCode()->toEqual(expected: $expected);

    return $this;
});

expect()->extend(name: 'toHaveJsonContent', extend: function (): Expectation {
    $this->getContent()->toBeJson();

    return $this;
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

/**
 * Set the current user for the application with the given abilities.
 */
function actingAs(User $user, array $abilities = ['*'], ?string $guard = null): mixed
{
    Sanctum::actingAs(user: $user, abilities: $abilities, guard: $guard);

    return test();
}

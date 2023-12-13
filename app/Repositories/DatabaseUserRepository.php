<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

final readonly class DatabaseUserRepository implements UserRepository
{
    /**
     * Create a new user.
     *
     * @throws Throwable
     */
    public function create(
        string $id,
        string $name,
        string $email,
        string $password,
        ?string $externalId = null,
    ): void {
        DB::transaction(callback: function () use (
            $id,
            $name,
            $email,
            $password,
            $externalId,
        ): void {
            $user = User::query()->create(attributes: [
                'id' => $id,
                'external_id' => $externalId,
                'name' => $name,
                'email' => $email,
                'password' => Hash::make(value: $password),
            ]);

            $user->markEmailAsVerified();
        });
    }
}

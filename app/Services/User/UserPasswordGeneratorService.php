<?php

declare(strict_types=1);

namespace App\Services\User;

use Illuminate\Support\Facades\Hash;

final readonly class UserPasswordGeneratorService
{
    /**
     * Create a new service instance.
     */
    public function __construct()
    {
    }

    /**
     * Generate a new password.
     */
    public function generatePassword(): string
    {
        return Hash::make(value: '123Pass&Word321');
    }
}

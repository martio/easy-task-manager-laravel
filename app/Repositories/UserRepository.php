<?php

declare(strict_types=1);

namespace App\Repositories;

interface UserRepository
{
    /**
     * Create a new user.
     */
    public function create(string $id, string $name, string $email, string $password): void;
}

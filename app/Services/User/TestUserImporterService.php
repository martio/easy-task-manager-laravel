<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Data\User\ExternalUser;

final readonly class TestUserImporterService implements UserImporterService
{
    /**
     * Create a new service instance.
     */
    public function __construct()
    {
    }

    /**
     * Import a user from the external source.
     */
    public function importUserFromExternalSource(string $externalId): ExternalUser
    {
        return new ExternalUser(
            id: $externalId,
            name: 'Test',
            email: "{$externalId}@dummy.com",
        );
    }
}

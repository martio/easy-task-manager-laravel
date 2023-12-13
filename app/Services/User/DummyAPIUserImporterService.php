<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Data\User\ExternalUser;

final readonly class DummyAPIUserImporterService implements UserImporterService
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
        /** @todo Import document from Dummy API service... */

        return new ExternalUser(
            id: $externalId,
            name: 'John Doe',
            email: "{$externalId}@dummy.com",
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Data\User\ExternalUser;

interface UserImporterService
{
    /**
     * Import a user from the external source.
     */
    public function importUserFromExternalSource(string $externalId): ExternalUser;
}

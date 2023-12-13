<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Data\User\ExternalUser;
use App\Exceptions\Services\UserImportFailedException;
use Illuminate\Support\Facades\Http;

final readonly class DummyAPIUserImporterService implements UserImporterService
{
    /** The base URL of the Dummy API service. */
    private string $baseUrl;

    /** @var string The application ID for the Dummy API service. */
    private string $appId;

    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        $this->baseUrl = 'https://dummyapi.io/data/v1';
        $this->appId = config(key: 'apis.dummyapi.app_id');
    }

    /**
     * Import a user from the external source.
     */
    public function importUserFromExternalSource(string $externalId): ExternalUser
    {
        $data = $this->importUserByIdFromDummyAPI(externalId: $externalId);

        return new ExternalUser(
            id: $data['id'],
            name: "{$data['firstName']} {$data['lastName']}",
            email: $data['email'],
        );
    }

    /**
     * Import a user by ID from the Dummy API service.
     *
     * @return array<string, mixed>
     *
     * @throws UserImportFailedException
     */
    private function importUserByIdFromDummyAPI(string $externalId): array
    {
        $response = Http::withHeaders(headers: [
            'app-id' => $this->appId,
        ])->get(url: "{$this->baseUrl}/user/{$externalId}");

        if ($response->successful()) {
            return $response->json();
        }

        throw new UserImportFailedException(
            externalId: $externalId,
            responseBody: $response->body(),
        );
    }
}

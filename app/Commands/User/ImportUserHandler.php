<?php

declare(strict_types=1);

namespace App\Commands\User;

use App\Events\User\UserImportedEvent;
use App\Helpers\Facades\Uid;
use App\Repositories\UserRepository;
use App\Services\User\UserImporterService;
use App\Services\User\UserPasswordGeneratorService;

final readonly class ImportUserHandler
{
    /**
     * Import a new command handler instance.
     */
    public function __construct(
        private UserImporterService $userImporterService,
        private UserPasswordGeneratorService $userPasswordGeneratorService,
        private UserRepository $userRepository,
    ) {
    }

    /**
     * Execute the action.
     */
    public function __invoke(ImportUserCommand $command): string
    {
        $userId = Uid::generate();

        $externalUser = $this->userImporterService->importUserFromExternalSource(
            externalId: $command->externalId,
        );

        $this->userRepository->create(
            id: $userId,
            name: $externalUser->name,
            email: $externalUser->email,
            password: $this->userPasswordGeneratorService->generatePassword(),
            externalId: $externalUser->id,
        );

        event(new UserImportedEvent(
            userId: $userId,
        ));

        return $userId;
    }
}

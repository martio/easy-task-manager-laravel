<?php

declare(strict_types=1);

namespace App\Commands\User;

use App\Events\User\UserCreatedEvent;
use App\Helpers\Facades\Uid;
use App\Repositories\UserRepository;

final readonly class CreateUserHandler
{
    /**
     * Create a new command handler instance.
     */
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * Execute the action.
     */
    public function __invoke(CreateUserCommand $command): string
    {
        $userId = Uid::generate();

        $this->userRepository->create(
            id: $userId,
            name: $command->name,
            email: $command->email,
            password: $command->password,
        );

        event(new UserCreatedEvent(
            userId: $userId,
        ));

        return $userId;
    }
}

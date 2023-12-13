<?php

declare(strict_types=1);

namespace App\Data\User;

use App\Data\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class ExternalUser extends Data
{
    /**
     * Create a new data instance.
     */
    public function __construct(
        #[Required]
        public string $id,
        #[Required]
        public string $name,
        #[Required]
        public string $email,
    ) {
    }
}

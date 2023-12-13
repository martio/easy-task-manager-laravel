<?php

declare(strict_types=1);

namespace App\Data\Task;

use App\Data\Data;
use App\Enums\Task\StatusEnum;
use App\Models\Task;
use App\States\Task\TaskState;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Transformers\EnumTransformer;

#[MapName(SnakeCaseMapper::class)]
final class TaskData extends Data
{
    /**
     * Create a new data instance.
     */
    public function __construct(
        #[Required]
        public string $id,
        #[Required]
        public string $userId,
        #[Required]
        public string $title,
        #[Required]
        public string $description,
        #[WithCast(EnumCast::class)]
        #[WithTransformer(EnumTransformer::class)]
        #[Required, Enum(StatusEnum::class)]
        public StatusEnum $status,
        #[WithCast(DateTimeInterfaceCast::class)]
        #[WithTransformer(DateTimeInterfaceTransformer::class)]
        #[Required, Date]
        public Carbon $createdAt,
    ) {
    }

    /**
     * Create a new data instance from the given model.
     */
    public static function fromModel(Task $model): self
    {
        /** @var TaskState $status */
        $status = $model->status;

        /** @var Carbon $createdAt */
        $createdAt = $model->created_at;

        return new TaskData(
            id: $model->id,
            userId: $model->user_id,
            title: $model->title,
            description: $model->description,
            status: $status->status(),
            createdAt: $createdAt,
        );
    }
}

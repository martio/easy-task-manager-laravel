<?php

declare(strict_types=1);

namespace App\Enums\Task;

use App\Enums\Concerns\Equalable;
use App\States\Task\Completed;
use App\States\Task\InProgress;
use App\States\Task\Pending;
use App\States\Task\TaskState;

enum StatusEnum: string
{
    use Equalable;

    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    /**
     * Get the state.
     *
     * @return class-string<TaskState>
     */
    public function state(): string
    {
        return match ($this) {
            StatusEnum::Pending => Pending::class,
            StatusEnum::InProgress => InProgress::class,
            StatusEnum::Completed => Completed::class,
        };
    }
}

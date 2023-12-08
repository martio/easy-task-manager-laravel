<?php

declare(strict_types=1);

namespace App\Enums\Task;

use App\Enums\Concerns\Equalable;

enum StatusEnum: string
{
    use Equalable;

    case Pending = 'pending';
    case InProgress = 'in progress';
    case Completed = 'completed';
}

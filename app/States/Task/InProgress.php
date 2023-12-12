<?php

declare(strict_types=1);

namespace App\States\Task;

use App\Enums\Task\StatusEnum;

class InProgress extends TaskState
{
    /**
     * Get the status.
     */
    public function status(): StatusEnum
    {
        return StatusEnum::InProgress;
    }
}

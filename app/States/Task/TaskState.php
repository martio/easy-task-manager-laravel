<?php

declare(strict_types=1);

namespace App\States\Task;

use App\Enums\Task\StatusEnum;
use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class TaskState extends State
{
    /**
     * Define the default value and allowed transitions.
     *
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(defaultStateClass: Pending::class)
            ->allowTransition(from: Pending::class, to: InProgress::class)
            ->allowTransition(from: InProgress::class, to: Completed::class);
    }

    /**
     * Get the status.
     */
    abstract public function status(): StatusEnum;
}

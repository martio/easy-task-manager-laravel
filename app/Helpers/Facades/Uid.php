<?php

declare(strict_types=1);

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;
use Override;

/**
 * @method static string generate()
 */
final class Uid extends Facade
{
    /**
     * Get the registered name of the component.
     */
    #[Override]
    protected static function getFacadeAccessor(): string
    {
        return 'uid';
    }
}

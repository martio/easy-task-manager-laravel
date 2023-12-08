<?php
/**
 * Sports Manager PRO.
 *
 * PHP version 8.3
 *
 * LICENSE: Sports Manager PRO can not be copied and/or distributed
 * without the express permission of Sports Manager PRO.
 *
 * @author    Marcin Lewandowski <marcin.lewandowski@appcadabra.pl>
 * @copyright 2023 appcadabra.pl
 */

namespace App\Models\Builders;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;

/**
 * Query Builders.
 *
 * @template TModelClass of Task
 *
 * @extends Builder<Task>
 */
final class TaskBuilder extends Builder
{
}

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

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Query Builders.
 *
 * @template TModelClass of User
 *
 * @extends Builder<User>
 */
final class UserBuilder extends Builder
{
}

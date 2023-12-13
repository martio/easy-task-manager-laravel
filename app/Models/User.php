<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Builders\UserBuilder;
use App\Models\Collections\TaskCollection;
use App\Models\Collections\UserCollection;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Override;

/**
 * App\Models\User
 *
 * @property string      $id
 * @property string|null $external_id
 * @property string      $name
 * @property string      $email
 * @property Carbon|null $email_verified_at
 * @property mixed       $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read TaskCollection<int, Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static UserCollection<int, static> all($columns = ['*'])
 * @method static UserFactory                 factory($count = null, $state = [])
 * @method static UserCollection<int, static> get($columns = ['*'])
 * @method static UserBuilder|User            newModelQuery()
 * @method static UserBuilder|User            newQuery()
 * @method static UserBuilder|User            query()
 * @method static UserBuilder|User            whereCreatedAt($value)
 * @method static UserBuilder|User            whereEmail($value)
 * @method static UserBuilder|User            whereEmailVerifiedAt($value)
 * @method static UserBuilder|User            whereExternalId($value)
 * @method static UserBuilder|User            whereId($value)
 * @method static UserBuilder|User            whereName($value)
 * @method static UserBuilder|User            wherePassword($value)
 * @method static UserBuilder|User            whereRememberToken($value)
 * @method static UserBuilder|User            whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasUlids;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'external_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the tasks for the user.
     *
     * @return HasMany<Task>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(related: Task::class);
    }

    /**
     * Determine whether the user is the owner of the given model.
     */
    public function isOwnerOf(Model $model): bool
    {
        if ( ! array_key_exists(key: 'user_id', array: $model->getAttributes())) {
            return false;
        }

        return $model->getAttribute(key: 'user_id') === $this->getAttribute(key: 'id');
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param Builder $query
     *
     * @return UserBuilder<User>
     */
    #[Override]
    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder(query: $query);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array<int, User> $models
     */
    #[Override]
    public function newCollection(array $models = []): UserCollection
    {
        return new UserCollection(items: $models);
    }
}

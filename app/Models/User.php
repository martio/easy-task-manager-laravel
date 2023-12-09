<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Builders\UserBuilder;
use App\Models\Collections\UserCollection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Override;

/**
 * App\Models\User
 *
 * @property string                          $id
 * @property string                          $name
 * @property string                          $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed                           $password
 * @property string|null                     $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Collections\TaskCollection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static UserCollection<int, static>     all($columns = ['*'])
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static UserCollection<int, static>     get($columns = ['*'])
 * @method static UserBuilder|User                newModelQuery()
 * @method static UserBuilder|User                newQuery()
 * @method static UserBuilder|User                query()
 * @method static UserBuilder|User                whereCreatedAt($value)
 * @method static UserBuilder|User                whereEmail($value)
 * @method static UserBuilder|User                whereEmailVerifiedAt($value)
 * @method static UserBuilder|User                whereId($value)
 * @method static UserBuilder|User                whereName($value)
 * @method static UserBuilder|User                wherePassword($value)
 * @method static UserBuilder|User                whereRememberToken($value)
 * @method static UserBuilder|User                whereUpdatedAt($value)
 *
 * @mixin \Eloquent
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

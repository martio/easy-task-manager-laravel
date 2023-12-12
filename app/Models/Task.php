<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Task\StatusEnum;
use App\Models\Builders\TaskBuilder;
use App\Models\Collections\TaskCollection;
use App\States\Task\Pending;
use App\States\Task\TaskState;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Override;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Task
 *
 * @property string      $id
 * @property string      $user_id
 * @property string      $title
 * @property string      $description
 * @property StatusEnum  $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 *
 * @method static TaskCollection<int, static> all($columns = ['*'])
 * @method static TaskFactory                 factory($count = null, $state = [])
 * @method static TaskCollection<int, static> get($columns = ['*'])
 * @method static TaskBuilder|Task            newModelQuery()
 * @method static TaskBuilder|Task            newQuery()
 * @method static TaskBuilder|Task            ofStatus(StatusEnum $status)
 * @method static TaskBuilder|Task            query()
 * @method static TaskBuilder|Task            whereCreatedAt($value)
 * @method static TaskBuilder|Task            whereDescription($value)
 * @method static TaskBuilder|Task            whereId($value)
 * @method static TaskBuilder|Task            whereStatus($value)
 * @method static TaskBuilder|Task            whereTitle($value)
 * @method static TaskBuilder|Task            whereUpdatedAt($value)
 * @method static TaskBuilder|Task            whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;
    use HasStates;
    use HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'status',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, class-string|string>
     */
    protected $casts = [
        'status' => TaskState::class,
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => Pending::class,
    ];

    /**
     * Get the user that owns the task.
     *
     * @return BelongsTo<User, Task>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }

    /**
     * Scope a query to only include tasks of the given status.
     *
     * @param TaskBuilder<Task> $query
     *
     * @return TaskBuilder<Task>
     */
    public function scopeOfStatus(TaskBuilder $query, StatusEnum $status): TaskBuilder
    {
        return $query->where(column: 'status', operator: '=', value: $status->state());
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param Builder $query
     *
     * @return TaskBuilder<Task>
     */
    #[Override]
    public function newEloquentBuilder($query): TaskBuilder
    {
        return new TaskBuilder(query: $query);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array<int, Task> $models
     */
    #[Override]
    public function newCollection(array $models = []): TaskCollection
    {
        return new TaskCollection(items: $models);
    }
}

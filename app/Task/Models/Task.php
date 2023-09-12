<?php

declare(strict_types=1);

namespace App\Task\Models;

use App\Core\Models\User;
use App\Core\Traits\WithFactory;
use App\Task\Enums\StatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read  $id
 * @property int $owner_id
 * @property null|int $parent_id
 * @property string $title
 * @property string $description
 * @property StatusEnum $status
 * @property int $priority
 * @property  Carbon $created_at
 * @property  Carbon|null $completed_at
 * @property User $owner
 * @property Task $parent
 * @property Collection<Task> $childrens
 *
 * @method static create(array $toModelFields)
 */
class Task extends Model
{
    use WithFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'completed_at',
    ];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_id', 'id');
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id', 'id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}

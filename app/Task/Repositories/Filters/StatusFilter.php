<?php

declare(strict_types=1);

namespace App\Task\Repositories\Filters;

use App\Task\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter implements IFilter
{
    public function __construct(private readonly StatusEnum $status)
    {
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('status', $this->status->value);
    }
}

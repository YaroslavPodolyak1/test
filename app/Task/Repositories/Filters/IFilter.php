<?php

declare(strict_types=1);

namespace App\Task\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

interface IFilter
{
    public function apply(Builder $query): Builder;
}

<?php
declare(strict_types=1);

namespace App\Task\Repositories\Filters;


use Illuminate\Database\Eloquent\Builder;

class TitleFilter implements IFilter
{

    public function __construct(private readonly string $searchable)
    {
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('title', 'LIKE', '%' . $this->searchable . '%');
    }
}

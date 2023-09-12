<?php

declare(strict_types=1);

namespace App\Task\Repositories\Filters;


use Illuminate\Database\Eloquent\Builder;

class PriorityFilter implements IFilter
{

    public function __construct(private readonly array $priotity)
    {

    }

    public function apply(Builder $query): Builder
    {
        if ($this->priotity['from'] && $this->priotity['to']) {
            return $query->whereIn('priority', [$this->priotity['from'], $this->priotity['to']]);
        } elseif ($this->priotity['from'] && !$this->priotity['to']) {
            return $query->where('priority', '>=', $this->priotity['from']);
        } elseif (!$this->priotity['from'] && $this->priotity['to']) {
            return $query->where('priority', '<=', $this->priotity['to']);
        }

        return $query;
    }
}

<?php

declare(strict_types=1);

namespace App\Task\Repositories;

use App\Task\DTO\CreateTaskDTO;
use App\Task\DTO\UpdateTaskDTO;
use App\Task\Enums\StatusEnum;
use App\Task\Models\Task;
use App\Task\Repositories\Filters\PriorityFilter;
use App\Task\Repositories\Filters\StatusFilter;
use App\Task\Repositories\Filters\TitleFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class EloquentTaskRepository
{
    public function create(CreateTaskDTO $dto): Task
    {
        return Task::create($dto->toModelFillableFields());
    }

    public function update(Task $task, UpdateTaskDTO $dto): Task
    {
        $task->update($dto->toModelFillableFields());

        return $task->fresh();
    }

    public function delete(Task $task): ?bool
    {
        return $task->delete();
    }

    public function complete(Task $task): Task
    {
        $task->completed_at = Carbon::now();
        $task->save();

        return $task->fresh();
    }

    public function getByFilters(array $filters = [], string $orderField = '', string $orderDirection = 'ASC'): Collection
    {
        $query = Task::query();

        if (array_key_exists('status', $filters)) {
            $query = (new StatusFilter(StatusEnum::tryFrom($filters['status'])))->apply($query);
        }

        if (array_key_exists('priority', $filters)) {
            $query = (new PriorityFilter($filters['priority']))->apply($query);
        }
        if (array_key_exists('title', $filters)) {
            $query = (new TitleFilter($filters['title']))->apply($query);
        }

        if (!empty($orderField)) {
            $query = $query->orderBy($orderField, $orderDirection);
        }

        return $query->get();
    }
}

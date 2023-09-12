<?php

declare(strict_types=1);

namespace App\Task\Actions;

use App\Task\DTO\UpdateTaskDTO;
use App\Task\Models\Task;
use App\Task\Repositories\EloquentTaskRepository;

class UpdateTaskAction
{

    public function __construct(private readonly EloquentTaskRepository $repository)
    {
    }

    public function execute(Task $task, UpdateTaskDTO $dto): Task
    {
        return $this->repository->update($task, $dto);
    }
}

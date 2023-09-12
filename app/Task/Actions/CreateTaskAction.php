<?php
declare(strict_types=1);

namespace App\Task\Actions;

use App\Task\DTO\CreateTaskDTO;
use App\Task\Models\Task;
use App\Task\Repositories\EloquentTaskRepository;

class CreateTaskAction
{
    public function __construct(private readonly EloquentTaskRepository $repository)
    {
    }

    public function execute(CreateTaskDTO $dto): Task
    {
        return $this->repository->create($dto);
    }
}

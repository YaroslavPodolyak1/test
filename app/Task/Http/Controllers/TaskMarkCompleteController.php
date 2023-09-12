<?php
declare(strict_types=1);

namespace App\Task\Http\Controllers;

use App\Task\Http\Resources\TaskJsonResource;
use App\Task\Models\Task;
use App\Task\Repositories\EloquentTaskRepository;

class TaskMarkCompleteController
{
    public function __invoke(Task $task, EloquentTaskRepository $repository)
    {
        return TaskJsonResource::make($repository->complete($task));
    }
}

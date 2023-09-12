<?php

declare(strict_types=1);

namespace App\Task\Http\Controllers;

use App\Task\Actions\CreateTaskAction;
use App\Task\Actions\UpdateTaskAction;
use App\Task\Http\Requests\StoreTaskRequest;
use App\Task\Http\Requests\UpdateTaskRequest;
use App\Task\Http\Resources\TaskJsonResource;
use App\Task\Http\Resources\TaskResourceCollection;
use App\Task\Models\Task;
use App\Task\Repositories\EloquentTaskRepository;
use Illuminate\Http\Request;

class TaskController
{
    public function index(Request $request, EloquentTaskRepository $repository): TaskResourceCollection
    {

        $filters = $request->only(['status', 'priority', 'title']);

        $orderField = '';
        $orderDirection = 'ask';

        if ($field = $request->order['field']) {
            $orderField = $field;
        }
        if ($direction = $request->order['direction']) {
            $orderDirection = $direction;
        }
        $tasks = $repository->getByFilters($filters, $orderField, $orderDirection);


        return TaskResourceCollection::make($tasks);
    }

    public function store(StoreTaskRequest $request, CreateTaskAction $action): TaskJsonResource
    {
        $task = $action->execute($request->dto());

        return TaskJsonResource::make($task);
    }

    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskAction $action)
    {
        return TaskJsonResource::make($action->execute($task, $request->dto()));
    }

    public function destroy(Task $task, EloquentTaskRepository $repository)
    {
        $repository->delete($task);
    }
}

<?php
declare(strict_types=1);

namespace App\Task\Policies;

use App\Task\Models\Task;
use Illuminate\Foundation\Auth\User;

class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id;
    }

    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->owner_id;
    }

    public function delete(User $user, Task $task): bool
    {
        return ($user->id === $task->owner_id) && is_null($task->completed_at);
    }

    public function markCompleted(User $user, Task $task): bool
    {
        if ($user->id !== $task->owner_id) {
            return false;
        }
        $isCompleted = $task->childrens->filter(function (Task $task) {
            return !is_null($task->completed_at);
        });

        return !($isCompleted->count() > 0);
    }
}

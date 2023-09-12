<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Core\Models\User;
use App\Task\Models\Task;
use Carbon\Carbon;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    public function testShowForIndex()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create(['owner_id' => $user->id]);

        Task::factory()->count(2)->create(['owner_id' => $user->id, 'parent_id' => $task->id]);

        $this->sanctumActingAs($user)
            ->put(route('tasks.complete', $task))
            ->dd();


    }
}

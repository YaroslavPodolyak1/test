<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Core\Models\User;
use App\Task\Enums\StatusEnum;
use App\Task\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'status' => StatusEnum::done(),
            'priority' => 1,
        ];
    }
}

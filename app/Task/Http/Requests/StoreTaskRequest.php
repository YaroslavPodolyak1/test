<?php
declare(strict_types=1);

namespace App\Task\Http\Requests;

use App\Task\DTO\CreateTaskDTO;
use App\Task\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:191'],
            'description' => ['required', 'string'],
            'status' => ['required', 'enum:' . StatusEnum::class],
            'priority' => ['required', 'integer'],
            'parent_id' => ['nullable', 'exists:tasks,id']
        ];
    }

    public function dto(): CreateTaskDTO
    {
        return CreateTaskDTO::fromRequest($this);
    }
}

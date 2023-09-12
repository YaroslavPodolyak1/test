<?php
declare(strict_types=1);

namespace App\Task\Http\Requests;

use App\Task\DTO\UpdateTaskDTO;
use App\Task\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:191'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'enum:' . StatusEnum::class],
            'priority' => ['nullable', 'integer'],
        ];
    }

    public function dto(): UpdateTaskDTO
    {
        return UpdateTaskDTO::fromRequest($this);
    }
}

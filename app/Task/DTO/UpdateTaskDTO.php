<?php

declare(strict_types=1);

namespace App\Task\DTO;

use App\Task\Enums\StatusEnum;
use App\Task\Http\Requests\UpdateTaskRequest;
use Spatie\LaravelData\Data;

class UpdateTaskDTO extends Data
{
    public function __construct(
        private readonly null|string $title,
        private readonly null|string $description,
        private readonly null|StatusEnum $status,
        private readonly null|int $priority,
    ) {
    }

    public static function fromRequest(UpdateTaskRequest $request): self
    {
        return new self(
            title: $request->input('title'),
            description: $request->input('description'),
            status: StatusEnum::tryFrom($request->input('status')),
            priority: $request->input('priority')
        );
    }

    public function toModelFillableFields(): array
    {
        return collect([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
        ])
            ->filter()
            ->toArray();
    }
}

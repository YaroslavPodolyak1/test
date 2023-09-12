<?php

declare(strict_types=1);

namespace App\Task\DTO;

use App\Core\Models\User;
use App\Task\Enums\StatusEnum;
use App\Task\Http\Requests\StoreTaskRequest;
use Spatie\LaravelData\Data;

class CreateTaskDTO extends Data
{
    public function __construct(
        private readonly User $owner,
        private readonly string $title,
        private readonly string $description,
        private readonly StatusEnum $status,
        private readonly int $priority,
        private readonly null|int $parentId
    ) {
    }

    public static function fromRequest(StoreTaskRequest $request): self
    {
        return new self(
            owner: $request->user(),
            title: $request->input('title'),
            description: $request->input('description'),
            status: StatusEnum::from($request->input('status')),
            priority: $request->input('priority'),
            parentId: $request->input('parent_id')
        );
    }

    public function toModelFillableFields(): array
    {
        return [
            'owner_id' => $this->owner->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'parent_id' => $this->parentId
        ];
    }
}

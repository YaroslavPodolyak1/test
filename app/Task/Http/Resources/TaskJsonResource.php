<?php

declare(strict_types=1);

namespace App\Task\Http\Resources;

use App\Task\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Task
 */
class TaskJsonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->label,
            'priority' => $this->priority,
            'completed_at' => $this->completed_at?->format('d.M.Y'),
        ];
    }
}

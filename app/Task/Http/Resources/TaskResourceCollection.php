<?php

declare(strict_types=1);

namespace App\Task\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskResourceCollection extends ResourceCollection
{
    public $collects = TaskJsonResource::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'status' => 'success',
            'http_code' => 200,
        ];
    }
}

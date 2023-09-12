<?php
declare(strict_types=1);

namespace App\Task\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self todo()
 * @method static self done()
 */
class StatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'todo' => 1,
            'done' => 2,
        ];
    }
}

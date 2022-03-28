<?php declare(strict_types=1);

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookUser extends Pivot
{
    public static array $statuses = [
        'WANT_TO_READ' => 'Want to read',
        'READING' => 'Reading',
        'READ' => 'Read',
    ];

    public function getActionAttribute(): string
    {
        return match ($this->status) {
            'WANT_TO_READ' => 'wants to read',
            'READING' => 'is reading',
            'READ' => 'has read',
        };
    }
}

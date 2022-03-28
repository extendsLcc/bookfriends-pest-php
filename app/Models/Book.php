<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'author',
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('status');
    }
}

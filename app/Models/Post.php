<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $guarded = [];
    const OPEN = 1;

    public function scopeOnlyOpen($query)
    {
        $query->where('status', self::OPEN);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

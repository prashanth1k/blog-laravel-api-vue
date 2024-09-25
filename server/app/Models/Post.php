<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'published_at',
        'slug',
        'imageUrl',
        'status',
        'tags',
        'categories',
        'user_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array',
        'categories' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

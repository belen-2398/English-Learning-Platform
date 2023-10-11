<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'commentable_id',
        'commentable_type',
        'user_id'
    ];

    protected $with = ['user', 'replies'];

    // public function scopeSort($query, $request)
    // {
    //     $sort = $request->input('sort');

    //     if ($sort === 'desc') {
    //         $query->orderBy('comments.created_at', 'desc');
    //     } else {
    //         $query->orderBy('comments.created_at', 'asc');
    //     }
    // }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function replies(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

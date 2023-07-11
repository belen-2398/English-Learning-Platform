<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'topic_id',
        'exerciseable_id',
        'exerciseable_type',
        'name',
        'level',
        'category',
        'order',
        'type',
        'status'
    ];
    /**
     * Get the user that owns the Exercise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function exerciseable(): MorphTo
    {
        return $this->morphTo();
    }
}

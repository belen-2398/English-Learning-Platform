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
        'topic_slide_id',
        'exerciseable_id',
        'exerciseable_type',
        'type',
    ];

    public function topicSlide(): BelongsTo
    {
        return $this->belongsTo(TopicSlide::class);
    }

    public function exerciseable(): MorphTo
    {
        return $this->morphTo();
    }
}

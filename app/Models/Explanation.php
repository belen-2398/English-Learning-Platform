<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Explanation extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_slide_id',
        'explanation',
    ];

    public function topicSlide(): BelongsTo
    {
        return $this->belongsTo(TopicSlide::class);
    }
}

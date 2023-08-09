<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TopicSlide extends Model
{
    use HasFactory;

    protected $table = 'topic_slides';

    protected $fillable = [
        'topic_id',
        'name',
        'order',
        'status',
    ];

    public function exercise(): HasOne
    {
        return $this->hasOne(Exercise::class);
    }

    public function explanation(): HasOne
    {
        return $this->hasOne(Explanation::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MixedExercise extends Model
{
    use HasFactory;

    protected $table = 'mixed_exercises';
    protected $fillable = [
        'lesson_id',
        'exerciseable_id',
        'exerciseable_type',
        'name',
        'order',
        'type',
        'status',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function exerciseable(): MorphTo
    {
        return $this->morphTo();
    }
}

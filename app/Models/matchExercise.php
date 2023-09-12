<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MatchExercise extends Model
{
    use HasFactory;

    protected $table = 'match_exercises';
    protected $fillable = [
        'left',
        'right'
    ];

    protected $casts = [
        'left' => 'array',
        'right' => 'array',
    ];

    public function exercise(): MorphOne
    {
        return $this->morphOne(Exercise::class, 'exerciseable');
    }

    public function mixedExercise(): MorphOne
    {
        return $this->morphOne(MixedExercise::class, 'mxexerciseable');
    }
}

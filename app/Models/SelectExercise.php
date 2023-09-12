<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SelectExercise extends Model
{
    use HasFactory;
    protected $table = 'select_exercises';
    protected $fillable = [
        'text',
        'answers'
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

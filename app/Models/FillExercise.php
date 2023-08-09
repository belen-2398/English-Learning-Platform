<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class FillExercise extends Model
{
    use HasFactory;
    protected $table = 'fill_exercises';
    protected $fillable = [
        'text',
        'words_to_fill'
    ];

    public function exercise(): MorphOne
    {
        return $this->morphOne(Exercise::class, 'exerciseable');
    }

    public function mixedExercise(): MorphOne
    {
        return $this->morphOne(MixedExercise::class, 'exerciseable');
    }
}

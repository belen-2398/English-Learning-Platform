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
        'left1',
        'right1',
        'left2',
        'right2',
        'left3',
        'right3',
        'left4',
        'right4',
        'left5',
        'right5',
        'left6',
        'right6',
        'left7',
        'right7',
        'left8',
        'right8',
        'left9',
        'right9',
        'left10',
        'right10',
    ];

    public function exercise(): MorphOne
    {
        return $this->morphOne(Exercise::class, 'exerciseable');
    }
}

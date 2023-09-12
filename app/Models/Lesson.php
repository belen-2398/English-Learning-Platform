<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'name',
        'description',
        'status',
        'order',
    ];

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function mixedExercises()
    {
        return $this->hasMany(MixedExercise::class);
    }
}

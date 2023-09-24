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
        'mxexerciseable_id',
        'mxexerciseable_type',
        'name',
        'prompt',
        'order',
        'type',
        'status',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function mxexerciseable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeSearch($query, $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        $statusParameter = $request->input('status_parameter');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
        } elseif ($statusParameter) {
            if ($statusParameter === 'visible') {
                $query->where('mixed_exercises.status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('mixed_exercises.status', 0);
            }
        } elseif ($searchText) {
            $query->where(function ($query) use ($searchText) {
                $query->where('mixed_exercises.name', 'LIKE', "%{$searchText}%")
                    ->orWhere('mixed_exercises.type', 'LIKE', "%{$searchText}%")
                    ->orWhere('mixed_exercises.prompt', 'LIKE', "%{$searchText}%")
                    ->orWhereHas('lesson', function ($query) use ($searchText) {
                        $query->where('lessons.name', 'LIKE', "%{$searchText}%");
                    });
            });
        }
    }

    public function scopeSort($query, $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('mixed_exercises.name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('mixed_exercises.order', $sort);
            } elseif ($sortBy === 'type') {
                $query->orderBy('mixed_exercises.type', $sort);
            } else {
                $query->orderBy('mixed_exercises.order', 'asc');
            }
        }
    }
}

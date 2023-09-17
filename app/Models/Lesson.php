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

    public function scopeSearch($query, $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        $statusParameter = $request->input('status_parameter');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
        } elseif ($statusParameter) {
            if ($statusParameter === 'visible') {
                $query->where('status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('status', 0);
            }
        } else {
            $query->where('name', 'LIKE', "%{$searchText}%")
                ->orWhere('description', 'LIKE', "%{$searchText}%");
        }
    }

    public function scopeSort($query, $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('order', $sort);
            } elseif ($sortBy === 'level') {
                $query->orderBy('level', $sort);
            } else {
                $query->orderBy('order', 'asc');
            }
        }
    }
}

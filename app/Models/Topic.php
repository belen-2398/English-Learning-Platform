<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'name',
        'category',
        'order',
        'points',
        'status',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function topicSlides(): HasMany
    {
        return $this->hasMany(TopicSlide::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
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
                $query->where('topics.status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('topics.status', 0);
            }
        } else {
            $query->where('topics.name', 'LIKE', "%{$searchText}%")
                ->orWhere('topics.category', 'LIKE', "%{$searchText}%")
                ->orWhere('topics.points', 'LIKE', "%{$searchText}%")
                ->orWhere('topics.order', 'LIKE', "%{$searchText}%")
                ->orWhereHas('lesson', function ($query) use ($searchText) {
                    $query->where('lessons.name', 'LIKE', "%{$searchText}%");
                });
        }
    }

    public function scopeSort($query, $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('topics.name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('topics.order', $sort);
            } elseif ($sortBy === 'lesson') {
                $query->orderBy('topics.lesson_id', $sort);
            } else {
                $query->orderBy('topics.order', 'asc');
            }
        }
    }
}

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
        'prompt',
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

    public function scopeSearch($query, $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        $statusParameter = $request->input('status_parameter');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
        } elseif ($statusParameter) {
            if ($statusParameter === 'visible') {
                $query->where('topic_slides.status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('topic_slides.status', 0);
            }
        } else {
            $query->where('topic_slides.name', 'LIKE', "%{$searchText}%")
                ->orWhere('topic_slides.order', 'LIKE', "%{$searchText}%")
                ->orWhere('topic_slides.prompt', 'LIKE', "%{$searchText}%")
                ->orWhereHas('topic', function ($query) use ($searchText) {
                    $query->where('topics.name', 'LIKE', "%{$searchText}%");
                });
        }
    }

    public function scopeSort($query, $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('topic_slides.name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('topic_slides.order', $sort);
            } elseif ($sortBy === 'topic') {
                $query->orderBy('topic_slides.topic_id', $sort);
            } else {
                $query->orderBy('topic_slides.order', 'asc');
            }
        }
    }
}

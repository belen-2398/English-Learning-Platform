<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordOfDay extends Model
{
    use HasFactory;

    protected $table = 'words_of_day';

    protected $fillable = [
        'word',
        'type',
        'pronunciation',
        'audio',
        'definition',
        'examples',
        'image',
        'publish_date'
    ];

    protected $casts = [
        'examples' => 'array',
    ];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->attributes['publish_date'])->format('d - F - Y');
    }

    public function scopeSearch($query, $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        $dateParameter = $request->input('date_parameter');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
        } elseif ($dateParameter) {
            if ($dateParameter === 'year') {
                $query->whereYear('publish_date', '=', $searchText);
            } elseif ($dateParameter === 'month') {
                $query->whereMonth('publish_date', '=', $searchText);
            } elseif ($dateParameter === 'date') {
                $searchText = Carbon::parse($searchText)->format('Y-m-d');
                $query->whereDate('publish_date', '=', $searchText);
            }
        } else {
            $query->where('word', 'LIKE', "%{$searchText}%")
                ->orWhere('type', 'LIKE', "%{$searchText}%")
                ->orWhere('definition', 'LIKE', "%{$searchText}%")
                ->orWhere('examples', 'LIKE', "%{$searchText}%")
                ->orWhere('publish_date', 'LIKE', "%{$searchText}%");
        }
    }

    public function scopeSort($query, $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'word') {
                $query->orderBy('word', $sort);
            } elseif ($sortBy === 'type') {
                $query->orderBy('type', $sort);
            } elseif ($sortBy === 'publish_date') {
                $query->orderBy('publish_date', $sort);
            } else {
                $query->orderBy('created_at', 'desc');
            }
        }
    }
}

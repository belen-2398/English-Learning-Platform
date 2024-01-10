<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DictionaryWord extends Model
{
    use HasFactory;

    protected $table = 'dictionary_words';

    protected $fillable = [
        'user_id',
        'word',
        'notes',
        'definition',
        'pronunciation',
        'examples',
        'translation',
    ];

    protected $casts = [
        'examples' => 'array',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearchAndSort($query, Request $request)
    {
        $searchText = $request->input('query');
        $sort = $request->input('sort', 'word.asc');

        return $query->where(function ($subquery) use ($searchText) {
            $subquery->where('word', 'LIKE', "%{$searchText}%")
                ->orWhere('notes', 'LIKE', "%{$searchText}%")
                ->orWhere('definition', 'LIKE', "%{$searchText}%")
                ->orWhere('pronunciation', 'LIKE', "%{$searchText}%")
                ->orWhere('translation', 'LIKE', "%{$searchText}%");
        })->orderBy($this->getSortColumn($sort), $this->getSortDirection($sort));
    }

    protected function getSortColumn($sort)
    {
        $columns = [
            'word.asc' => 'word',
            'word.desc' => 'word',
            'created.asc' => 'created_at',
            'created.desc' => 'created_at',
        ];

        return $columns[$sort] ?? 'word';
    }

    protected function getSortDirection($sort)
    {
        return str_ends_with($sort, 'desc') ? 'desc' : 'asc';
    }
    // public function scopeSearch($query, Request $request)
    // {
    //     $searchText = $request->input('query');

    //     return $query->where('word', 'LIKE', "%{$searchText}%")
    //         ->orWhere('notes', 'LIKE', "%{$searchText}%")
    //         ->orWhere('definition', 'LIKE', "%{$searchText}%")
    //         ->orWhere('pronunciation', 'LIKE', "%{$searchText}%")
    //         ->orWhere('translation', 'LIKE', "%{$searchText}%");
    // }

    // public function scopeSort($query, $request)
    // {
    //     $sort = $request->input('sort');

    //     if ($sort) {
    //         if ($sort === 'word.asc') {
    //             return $query->orderBy('word', 'asc');
    //         } elseif ($sort === 'word.desc') {
    //             return $query->orderBy('word', 'desc');
    //         } elseif ($sort === 'created.asc') {
    //             return $query->orderBy('created_at', 'asc');
    //         } elseif ($sort === 'created.desc') {
    //             return $query->orderBy('created_at', 'desc');
    //         }
    //     } else {
    //         return $query->orderBy('word', 'asc');
    //     }
    // }
}

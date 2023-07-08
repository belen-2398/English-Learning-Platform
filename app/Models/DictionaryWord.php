<?php

namespace App\Models;

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
        'example1',
        'example2',
        'example3',
        'translation',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
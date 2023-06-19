<?php

namespace App\Models;

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
        'example1',
        'example2',
        'example3',
        'example4',
        'example5',
        'image',
        'status'
    ];
}

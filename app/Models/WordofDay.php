<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordofDay extends Model
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
        'addToDictionary',
        'status'
    ];
}

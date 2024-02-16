<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultimediaGenre extends Model
{
    use HasFactory;

    protected $table = 'multimedia_genre'; // nome da tabela explicitamente(normalemente plural)

    protected $fillable = [
        'multimedia_id',
        'genre_id',
    ];
}
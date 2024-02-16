<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres'; // nome da tabela explicitamente(normalemente plural)
    protected $fillable = [
        'name',
    ];


    // ou seja uma genre pode "pertencer/ter" muitas multimedias, atraves da tabela relacional multimedia_genre
    public function multimedias()
    {
        return $this->belongsToMany(Multimedia::class, 'multimedia_genre', 'genre_id', 'multimedia_id');
    }
}

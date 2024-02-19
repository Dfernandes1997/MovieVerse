<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'multimedia'; // nome da tabela explicitamente(normalemente plural)

    protected $fillable = [
        'title',
        'year',
        'released',
        'runtime',
        'plot',
        'language',
        'country',
        'awards',
        'poster',
        'box_office',
        'type_id',
        'metascore',
        'imdb_rating',
        'imdb_votes',
    ];

    // convenção o type_id que pertence ao type model 
    public function type()
    {
        return $this->belongsTo(Type::class); 
    }

    // ou seja uma multimedia pode "pertencer/ter" muitas persons, atraves da tabela relacional persons_role
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'persons_role', 'multimedia_id', 'person_id')->withPivot('role');
    }


    // ou seja uma multimedia pode "pertencer/ter" muitas genres, atraves da tabela relacional multimedia_genre
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'multimedia_genre', 'multimedia_id', 'genre_id');
    }

    // ou seja uma multimedia pode "pertencer" muitas favoritos, atraves da tabela relacional multimedia_favoritos
    public function favoritos()
    {
        return $this->belongsToMany(Favoritos::class, 'multimedia_favoritos')->withPivot('id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); // uma multimedia pode ter varios comments
    }

    public function likes()
    {
        return $this->hasMany(Like::class); // uma multimedia pode ter varios likes 
    }
}

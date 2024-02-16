<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    use HasFactory;

    protected $table = 'favoritos'; // nome da tabela explicitamente
    protected $fillable = ['user_id', 'name'];

    /**
     * Define o relacionamento com users.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define o relacionamento com multimedia.
     */
    public function multimedia()
    {
        return $this->belongsToMany(Multimedia::class, 'multimedia_favoritos')->withPivot('id'); // ou seja uma favoritos pode "pertencer/ter" muitas multimedias
    }
}

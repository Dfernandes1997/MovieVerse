<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultimediaFavoritos extends Model
{
    use HasFactory;

    protected $table = 'multimedia_favoritos'; // nome da tabela explicitamente(normalemente plural)

    protected $fillable = [
        'favoritos_id',
        'multimedia_id',
    ];
}

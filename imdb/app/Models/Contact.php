<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts'; // nome da tabela explicitamente(normalmente plural)
    protected $fillable = [
        'name',
        'contato',
        'titulo',
        'mensagem',
        'read',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types'; // nome da tabela explicitamente(normalmente plural)
    
    protected $fillable = [
        'name',
    ];
}

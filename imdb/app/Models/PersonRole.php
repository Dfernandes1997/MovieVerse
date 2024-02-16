<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonRole extends Model
{
    use HasFactory;

    protected $table = 'persons_role'; // nome da tabela explicitamente(normalemente plural)
    protected $fillable = [
        'multimedia_id',
        'person_id',
        'role',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons'; // nome da tabela explicitamente
    protected $fillable = [
        'name',
    ];


    // ou seja uma person pode "pertencer/ter" muitas multimedias, atraves da tabela relacional persons_role
    public function multimedias()
    {
        return $this->belongsToMany(Multimedia::class, 'persons_role', 'person_id', 'multimedia_id')
                    ->withPivot('role');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'multimedia_id', 'content', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function multimedia()
    {
        return $this->belongsTo(Multimedia::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
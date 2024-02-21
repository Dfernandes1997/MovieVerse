<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comment_id'];

    // Relação: Um like pertence a um user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação: Um like pertence a um comentário
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}

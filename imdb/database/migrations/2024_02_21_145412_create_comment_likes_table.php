<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentLikesTable extends Migration
{
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained()->onDelete('cascade'); // foreignkey
            $table->integer('comment_id')->constrained()->onDelete('cascade'); // foreignkey
            $table->timestamps();

            $table->unique(['user_id', 'comment_id']); // Garante que um usuário só pode dar like uma vez em um comment
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_likes');
    }
}

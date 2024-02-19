<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained()->onDelete('cascade'); // foreignkey
            $table->integer('multimedia_id')->constrained()->onDelete('cascade'); // foreignkey
            $table->timestamps();

            $table->unique(['user_id', 'multimedia_id']); // Garante que um usuário só pode dar like uma vez em uma multimedia
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}

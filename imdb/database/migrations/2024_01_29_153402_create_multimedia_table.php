<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('year')->nullable();
            $table->string('released')->nullable();
            $table->string('runtime')->nullable();
            $table->string('plot')->nullable();
            $table->string('language')->nullable();
            $table->string('country')->nullable();
            $table->string('awards')->nullable();
            $table->string('poster')->nullable(); // aqui vou meter o caminho da imagem
            $table->string('box_office')->nullable();
            $table->integer('type_id');
            $table->string('metascore')->nullable();
            $table->string('imdb_rating')->nullable();
            $table->integer('imdb_votes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedia');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultimediaFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedia_favoritos', function (Blueprint $table) {
            $table->id();
            $table->integer('favoritos_id'); //foreignkey
            $table->integer('multimedia_id'); // foreignkey
            $table->timestamps();

            // Adiciona uma restrição única para os pares multimedia_id e favoritos_id
            $table->unique(['multimedia_id', 'favoritos_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedia_favoritos');
    }
}

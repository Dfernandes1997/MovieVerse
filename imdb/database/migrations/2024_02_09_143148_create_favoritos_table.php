<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); //foreignkey
            $table->string('name');
            $table->timestamps();

            //Por implementar, nomeunico para listas por user ??? // Adicionando uma restrição única para nome_lista e user_id
            // $table->unique(['user_id', 'nome_lista']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoritos');
    }
}

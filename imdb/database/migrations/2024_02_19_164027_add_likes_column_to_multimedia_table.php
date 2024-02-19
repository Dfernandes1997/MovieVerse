<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLikesColumnToMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multimedia', function (Blueprint $table) {
            $table->integer('likes')->default(0)->after('imdb_votes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multimedia', function (Blueprint $table) {
            $table->dropColumn('likes');
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\MultimediaFavoritos;
use Illuminate\Database\Seeder;

class MultimediaFavoritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // Adicionar dois filmes á lista filmes criada no seeder favorito e adicionar dois animes á lista animes, experimentar adicionar um filme de anime aos dois 
    public function run()
    {
        MultimediaFavoritos::truncate();

        MultimediaFavoritos::create([
            'favoritos_id' => 1,
            'multimedia_id' => 29,
        ]);
    
        MultimediaFavoritos::create([
            'favoritos_id' => 1,
            'multimedia_id' => 26,
        ]);

        MultimediaFavoritos::create([
            'favoritos_id' => 1,
            'multimedia_id' => 54,
        ]);

        MultimediaFavoritos::create([
            'favoritos_id' => 1,
            'multimedia_id' => 30,
        ]);

        MultimediaFavoritos::create([
            'favoritos_id' => 2,
            'multimedia_id' => 55,
        ]);

        MultimediaFavoritos::create([
            'favoritos_id' => 2,
            'multimedia_id' => 50,
        ]);
    
        MultimediaFavoritos::create([
            'favoritos_id' => 2,
            'multimedia_id' => 57,
        ]);

        MultimediaFavoritos::create([
            'favoritos_id' => 2,
            'multimedia_id' => 54,
        ]);
    
    }
}

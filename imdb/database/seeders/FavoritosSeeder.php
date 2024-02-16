<?php

namespace Database\Seeders;

use App\Models\Favoritos;
use Illuminate\Database\Seeder;

class FavoritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // Criar seeder no usar Diogo Fernandes para experimentar, lista de filmes e Animes
    public function run()
    {
        Favoritos::truncate();

        Favoritos::create([
            'user_id' => 1,
            'name' => 'Filmes',
        ]);

        Favoritos::create([
            'user_id' => 1,
            'name' => 'Animes',
        ]);
    }
}

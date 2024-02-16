<?php

namespace App\Jobs;

use App\Models\MultimediaGenre;
use App\Models\Person;
use App\Models\PersonRole;
use App\Models\Type;
use App\Models\Genre;
use App\Models\Multimedia;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessIMDBDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i = 4508902; $i <= 4508902; $i++) {
            $imdbID = 'tt' . str_pad($i, 7, '0', STR_PAD_LEFT);
            $response = Http::get("https://www.omdbapi.com/?i=$imdbID&apikey=4c31e00c");

            if ($response->successful()) {
                $data = $response->json();
                // dd($data);

                //lidar caso a api não tenha dados 
                if($data['Response'] === 'False'){
                    continue;
                }
            
                /////////////////Tabela types
                $typeName = $data['Type'];
                // Verificar se o tipo já existe na tabela Types
                $existingtype = Type::where('name', $typeName)->first();
                // Se não existir um tipo com o mesmo nome, criar um novo registo
                if (!$existingtype) {
                    $newType = Type::create(['name' => $typeName]);
                    $typeId = $newType->id; // id para usar em multimedia como FK
                }else {
                    // Se o tipo existir, obtenho o ID para usar como FK
                    $typeId = $existingtype->id;
                }

                //////////////////Tabela genres
                $genres = explode(', ', $data['Genre']);
                // Verificar se o genre ou genres já existe na tabela Genres
                foreach ($genres as $genreName){
                    if ($genreName !== 'N/A') {
                        $existingGenre = Genre::where('name', $genreName)->first();
                        // Se não existir um gênero com o mesmo nome, criar um novo registo
                        if (!$existingGenre) {
                            Genre::create(['name' => $genreName]);
                        }
                    }
                }

                //////////////////Tabela persons

                // Separar os valores por vírgula e remover espaços em branco extras
                $directors = array_map('trim', explode(',', $data['Director']));
                $writers = array_map('trim', explode(',', $data['Writer']));
                $actors = array_map('trim', explode(',', $data['Actors']));

                foreach ($directors as $director) {
                    if ($director !== 'N/A') {
                        // Verificar se já existe na tabela
                        $existingDirector = Person::where('name', $director)->first();
                        if (!$existingDirector) {
                            // Criar um novo registro na tabela persons para o diretor
                            Person::create(['name' => $director]);
                        }
                    }
                }

                foreach ($writers as $writer) {
                    if ($writer !== 'N/A') {
                        // Verificar se o escritor já existe na tabela
                        $existingWriter = Person::where('name', $writer)->first();
                        if (!$existingWriter) {
                            // Criar um novo registro na tabela persons para o escritor
                            Person::create(['name' => $writer]);
                        }
                    }
                }


                foreach ($actors as $actor) {
                    if ($actor !== 'N/A') {
                        // Verificar se o ator já existe na tabela
                        $existingActor = Person::where('name', $actor)->first();
                        if (!$existingActor) {
                            // Criar um novo registro na tabela persons para o ator
                            Person::create(['name' => $actor]);
                        }
                    }
                }


                //////////////////Tabela multimedia

                $existingmultimedia = Multimedia::where('title', $data['Title'])->first();
                if (!$existingmultimedia) {
                    $imdbVotes = isset($data['imdbVotes']) && $data['imdbVotes'] !== 'N/A' ? (int) str_replace(',', '', $data['imdbVotes']) : null;//converter para inteiro

                    $multimedia = Multimedia::create([
                        'title' => $data['Title'],
                        'year' => isset($data['Year']) && $data['Year'] !== 'N/A' ? $data['Year'] : null, // cada campo destesse não existir ou se tiver N/A fica como nul
                        'released' => isset($data['Released']) && $data['Released'] !== 'N/A' ? $data['Released'] : null,
                        'runtime' => isset($data['Runtime']) && $data['Runtime'] !== 'N/A' ? $data['Runtime'] : null,
                        'plot' => isset($data['Plot']) && $data['Plot'] !== 'N/A' ? $data['Plot'] : null,
                        'language' => isset($data['Language']) && $data['Language'] !== 'N/A' ? $data['Language'] : null,
                        'country' => isset($data['Country']) && $data['Country'] !== 'N/A' ? $data['Country'] : null,
                        'awards' => isset($data['Awards']) && $data['Awards'] !== 'N/A' ? $data['Awards'] : null,
                        'poster' => isset($data['Poster']) && $data['Poster'] !== 'N/A' ? $data['Poster'] : null,
                        'box_office' => isset($data['BoxOffice']) && $data['BoxOffice'] !== 'N/A' ? $data['BoxOffice'] : null,
                        'type_id' => $typeId, // Definir o type_id como o ID do tipo correspondente
                        'metascore' => isset($data['Metascore']) && $data['Metascore'] !== 'N/A' ? $data['Metascore'] : null,
                        'imdb_rating' => isset($data['imdbRating']) && $data['imdbRating'] !== 'N/A' ? $data['imdbRating'] : null,
                        'imdb_votes' => $imdbVotes,
                    ]);


                    // Obter o ID da multimedia recém-criada para usar como FK
                    $multimediaId = $multimedia->id;
                }else {
                    $multimediaId = $existingmultimedia->id;
                }



                //////////////////Tabela interrelacional multimedia_genre

                foreach ($genres as $genreName) {
                    if ($genreName !== 'N/A') {
                        // Obter o ID do gênero correspondente na tabela genres
                        $genre = Genre::where('name', $genreName)->first();
                        if ($genre) {
                            $genreId = $genre->id;
                            // Inserir o registo na tabela multimedia_genre, se tiver mais de dois genres vai inserir mais de um registo 
                            MultimediaGenre::create([
                                'multimedia_id' => $multimediaId,
                                'genre_id' => $genreId,
                            ]);
                        }
                    }
                }

                //////////////////Tabela interrelacional person_role

                foreach (['Director' => $directors, 'Writer' => $writers, 'Actor' => $actors] as $role => $people) {
                    foreach ($people as $personName) {
                        if ($personName !== 'N/A') {
                            // Vai buscar as pessoas da tabela 
                            $existingPerson = Person::where('name', $personName)->first();
                
                            // Criar uma entrada na tabela person_role associando a pessoa ao papel correspondente
                            PersonRole::create([
                                'multimedia_id' => $multimediaId,
                                'person_id' => $existingPerson->id,
                                'role' => $role,
                            ]);
                        }
                    }
                }


            }
        }
    }
}

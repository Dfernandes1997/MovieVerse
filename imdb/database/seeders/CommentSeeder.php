<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar alguns comentários de exemplo para começar a criar o front
        Comment::create([
            'user_id' => 1,
            'multimedia_id' => 29,
            'content' => 'Best movie ever!!',
            'parent_id' => null,
        ]);

        Comment::create([
            'user_id' => 2,
            'multimedia_id' => 29,
            'content' => 'This movie is a masterpiece.',
            'parent_id' => null,
        ]);

        Comment::create([
            'user_id' => 3,
            'multimedia_id' => 29,
            'content' => 'I agree, its awesome!',
            'parent_id' => 1,
        ]);

        Comment::create([
            'user_id' => 4,
            'multimedia_id' => 29,
            'content' => 'Yes it is!',
            'parent_id' => 2,
        ]);

        Comment::create([
            'user_id' => 5,
            'multimedia_id' => 29,
            'content' => 'The best movie ever!',
            'parent_id' => 2,
        ]);
    }
}

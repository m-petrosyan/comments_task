<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i += 5) {
            Comment::factory()->count($i)->create();
        }
    }
}


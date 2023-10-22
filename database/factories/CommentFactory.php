<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'post_id' => Post::inRandomOrder()->value('id'),
            'parent_id' => Comment::inRandomOrder()->value('id'),
            'content' => $this->faker->text,
            'created_at' => $this->faker->dateTime,
        ];
    }
}

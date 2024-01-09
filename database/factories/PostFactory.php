<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck("id")->toArray();
        $postContent = implode("\n", fake()->paragraphs(5));    
        return [
            'post_content' => $postContent,
            'uuid'         => Str::uuid(),
            'user_id'      => fake()->randomElement($userIds),
        ];
    }
}

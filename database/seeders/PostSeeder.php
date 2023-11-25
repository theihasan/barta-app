<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $userIds = DB::table('users')->pluck('id')->toArray();
        for ($i = 0; $i < 49950; $i++) {
            $postContent = implode("\n", $faker->paragraphs());
            DB::table('posts')->insert([
                'post_content' => $postContent,
                'uuid'         => $faker->uuid(),
                'user_id'      => $faker->randomElement($userIds), // Randomly select a user ID
                'created_at'   => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5000; $i++) {
            DB::table("users")->insert([
                "name"      => $faker->name,
                "username"  => $faker->userName,
                "bio"       => $faker->realText($maxNbChars = 200, $indexSize = 2),
                "email"     => $faker->email,
                "password"=> bcrypt("123456"),
                "created_at" => now(),
            ]);
        }
    }
}

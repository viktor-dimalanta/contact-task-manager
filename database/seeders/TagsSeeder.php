<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Faker\Factory as Faker;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            Tag::create([
                'tag_name' => $faker->unique()->word,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => now(),
            ]);
        }
    }
}
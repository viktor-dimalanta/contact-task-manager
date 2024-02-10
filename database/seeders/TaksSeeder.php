<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Faker\Factory as Faker;

class TaksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            Task::create([
                'task_name' => $faker->sentence,
                'for' => $faker->name,
                'status' => $faker->randomElement(['1', '0']),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => now(),
            ]);
        }
    }
}

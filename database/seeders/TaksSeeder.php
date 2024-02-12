<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class TaksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $options = ['App\Models\Person', 'App\Models\Business'];

        for ($i = 0; $i < 30; $i++) {
            Task::create([
                'task_name' => $faker->sentence,
                'description' => $faker->sentence,
                'for' => $faker->name,
                'status' => $faker->randomElement(['1', '0']),
                'taskable_id' => mt_rand(1, 30),
                'taskable_type' =>  Arr::random($options),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => now(),
            ]);
        }
    }
}

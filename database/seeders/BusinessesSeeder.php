<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use Faker\Factory as Faker;

class BusinessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            Business::create([
                'business_name' => $faker->company,
                'business_id' => $faker->unique()->uuid,
                'email' => $faker->email,
                'categories' => $faker->randomElement(['category1', 'category2', 'category3']),
                'tags' => json_encode($faker->words(3)),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => now(),
            ]);
        }
    }
}

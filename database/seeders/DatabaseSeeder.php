<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Call other seeder classes here
        $this->call([
            BusinessesSeeder::class,
            CategoriesSeeder::class,
            PeopleSeeder::class,
            TagsSeeder::class,
            TaksSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;

class BusinessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Insert sample data into the businesses table
         for ($i = 1; $i <= 100; $i++) {
            Business::create([
                'business_name' => 'Sample Business ' . $i,
                'email' => 'sample' . $i . '@example.com',
                'categories' => 'Category ' . $i,
                'tags' => 'Tag ' . $i . ', Tag ' . ($i + 1),
            ]);
        }
    }
}

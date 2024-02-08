<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            Person::create([
                'name' => 'Person ' . $i,
                'email' => 'person' . $i . '@example.com',
                'phone' => '123456789' . $i,
                'business' => 'Business ' . $i,
                'tags' => 'Tag ' . $i . ', Tag ' . ($i + 1),
            ]);
        }
    }
}

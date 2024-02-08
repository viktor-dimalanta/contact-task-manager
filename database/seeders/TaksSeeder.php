<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            Task::create([
                'task_name' => 'Task ' . $i,
                'for' => 'Person ' . $i,
                'status' => 'Pending', // You can change this to other statuses as needed
            ]);
        }
    }
}

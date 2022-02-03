<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        TaskStatus::factory()->create();

        Task::factory()->forStatus(['name' => 'Using status'])->forAuthor(['name' => 'Using user'])->create();
    }
}

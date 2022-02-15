<?php

namespace Database\Seeders;

use App\Models\Label;
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
        Label::factory()->create();

        Task::factory()
            ->forStatus(['name' => 'Using status'])
            ->forAuthor(['name' => 'Using user'])
            ->hasLabels(1, ['name' => 'Using label'])
            ->create();
    }
}

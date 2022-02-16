<?php

namespace Database\Seeders;

use App\Enum\TaskStatusNameEnum;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (TaskStatusNameEnum::list() as $name) {
            $status = new TaskStatus();
            $status->name = $name;
            $status->save();
        }
    }
}

<?php

namespace App\Factory;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

final class TaskFactory
{
    public function create(): Task
    {
        return new Task();
    }

    public function createWithAuthor(): Task
    {
        $task = $this->create();
        $task->author()->associate(Auth::user());

        return $task;
    }
}

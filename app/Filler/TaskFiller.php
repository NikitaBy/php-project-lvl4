<?php

namespace App\Filler;

use App\Models\Task;

final class TaskFiller
{
    public function fillOnCreate(Task $task, array $data): void
    {
        $this->fillAndSave($task, $data);

        if (isset($data['labels'])) {
            $task->labels()->attach($data['labels']);
        }
    }

    public function fillOnUpdate(Task $task, array $data): void
    {
        $this->fillAndSave($task, $data);

        if (isset($data['labels'])) {
            $labels = collect($data['labels'])->filter()->all();
            $task->labels()->sync($labels);
        }
    }

    public function fillAndSave(Task $task, array $data): void
    {
        $task->fill($data);
        $task->save();
    }
}

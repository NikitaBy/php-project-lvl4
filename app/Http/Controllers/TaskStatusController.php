<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'taskStatus');
    }

    public function create()
    {
        $taskStatus = new TaskStatus();

        return view('task_status.create', compact('taskStatus'));
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks()->count()) {
            flash('Не удалось удалить статус')->error();

            return redirect()->route('taskStatus.index');
        }

        $taskStatus->delete();

        return redirect()->route('taskStatus.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    public function index()
    {
        $taskStatuses = TaskStatus::paginate();

        return view('task_status.index', compact('taskStatuses'));
    }

    public function show(TaskStatus $taskStatus)
    {
        return redirect()->route('taskStatus.index');
    }

    public function store(StoreTaskStatusRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()->route('taskStatus.index');
    }

    public function update(StoreTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $data = $request->validated();

        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()->route('taskStatus.index');
    }
}

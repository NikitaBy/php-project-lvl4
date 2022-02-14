<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function create()
    {
        $task = new Task();

        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.create', compact('task', 'statuses', 'users', 'labels'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('task.index');
    }

    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function index()
    {
        $tasks = Task::paginate();

        return view('task.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $task = new Task();
        $task->fill($data);
        $task->author()->associate(Auth::user());
        $task->save();

        $task->labels()->attach($data['labels']);

        return redirect()->route('task.index');
    }

    public function update(StoreTaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();

        $task->fill($data);
        $task->labels()->attach($data['labels']);
        $task->save();

        return redirect()->route('task.index');
    }
}

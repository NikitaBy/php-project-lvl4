<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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

        flash(__('app.flash.task.delete.success'))->success();

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
        $query = optional(request())->query();
        $query = $query['filter'] ?? [];

        $tasks = QueryBuilder::for(Task::class)
            ->with(['status', 'author', 'assign'])
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->paginate(5)
            ->appends($query);

        $users = User::all();
        $statuses = TaskStatus::all();

        return view('task.index', compact('tasks', 'users', 'statuses', 'query'));
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

        if (isset($data['labels'])) {
            $task->labels()->attach($data['labels']);
        }

        flash(__('app.flash.task.create'))->success();

        return redirect()->route('task.index');
    }

    public function update(StoreTaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        if (isset($data['labels'])) {
            $labels = collect($data['labels'])->filter()->all();
            $task->labels()->sync($labels);
        }

        flash(__('app.flash.task.update'))->success();

        return redirect()->route('task.index');
    }
}

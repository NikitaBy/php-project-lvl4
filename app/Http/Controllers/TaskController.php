<?php

namespace App\Http\Controllers;

use App\Factory\TaskFactory;
use App\Filler\TaskFiller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Repository\TaskRepository;
use App\Service\FlashRenderer;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * @var FlashRenderer
     */
    private $flashRenderer;

    /**
     * @var TaskFactory
     */
    private $taskFactory;

    /**
     * @var TaskFiller
     */
    private $taskFiller;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(
        TaskFactory $taskFactory,
        TaskRepository $taskRepository,
        FlashRenderer $flashRenderer,
        TaskFiller $taskFiller
    ) {
        $this->authorizeResource(Task::class, 'task');

        $this->flashRenderer = $flashRenderer;
        $this->taskFactory = $taskFactory;
        $this->taskFiller = $taskFiller;
        $this->taskRepository = $taskRepository;
    }

    public function create()
    {
        $task = $this->taskFactory->create();

        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.create', compact('task', 'statuses', 'users', 'labels'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        $this->flashRenderer->renderSuccessFlash('app.flash.task.delete.success');

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

        $tasks = $this->taskRepository->findByFilter($query);

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

        $task = $this->taskFactory->createWithAuthor();
        $this->taskFiller->fillOnCreate($task, $data);

        $this->flashRenderer->renderSuccessFlash('app.flash.task.create');

        return redirect()->route('task.index');
    }

    public function update(StoreTaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();

        $this->taskFiller->fillOnUpdate($task, $data);

        $this->flashRenderer->renderSuccessFlash('app.flash.task.update');

        return redirect()->route('task.index');
    }
}

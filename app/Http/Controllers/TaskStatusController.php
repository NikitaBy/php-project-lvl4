<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Models\TaskStatus;
use App\Service\FlashRenderer;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    /**
     * @var FlashRenderer
     */
    private $flashRenderer;

    public function __construct(FlashRenderer $flashRenderer)
    {
        $this->authorizeResource(TaskStatus::class, 'taskStatus');
        $this->flashRenderer = $flashRenderer;
    }

    public function create()
    {
        $taskStatus = new TaskStatus();

        return view('task_status.create', compact('taskStatus'));
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks()->count()) {
            $this->flashRenderer->renderErrorFlash('app.flash.status.delete.error');

            return redirect()->route('taskStatus.index');
        }

        $taskStatus->delete();

        $this->flashRenderer->renderSuccessFlash('app.flash.status.delete.success');

        return redirect()->route('taskStatus.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    public function index()
    {
        $taskStatuses = TaskStatus::paginate(5);

        return view('task_status.index', compact('taskStatuses'));
    }

    public function store(StoreTaskStatusRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $taskStatus = new TaskStatus();
        $this->setTaskStatusData($taskStatus, $data);

        $this->flashRenderer->renderSuccessFlash('app.flash.status.create');

        return redirect()->route('taskStatus.index');
    }

    public function update(StoreTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $data = $request->validated();

        $this->setTaskStatusData($taskStatus, $data);

        $this->flashRenderer->renderSuccessFlash('app.flash.status.update');

        return redirect()->route('taskStatus.index');
    }

    private function setTaskStatusData(TaskStatus $taskStatus, array $data): void
    {
        $taskStatus->fill($data);
        $taskStatus->save();
    }
}

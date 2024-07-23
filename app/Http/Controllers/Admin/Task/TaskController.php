<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Task\StoreTaskRequest;
use App\Services\Task\TaskService;
use App\Services\User\UserService;

class TaskController extends Controller
{
    const PAGINATION_LIMIT = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskService $taskService, UserService $userService)
    {
       $this->taskService = $taskService;
       $this->userService = $userService;
    }

    public function index()
    {
        $tasks = $this->taskService->getPaginated(self::PAGINATION_LIMIT, ['assigner:id,name', 'assignee:id,name']);
        
        return view('admin.task.index', [
            'title' => 'Tasks',
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        $admins = $this->userService->getAllAdmins(['id', 'name']);
        $normalUsers = $this->userService->getAllNormalUsers(['id', 'name']);

        return view('admin.task.create', [
            'title' => 'Create Tasks',
            'admins' => $admins,
            'normalUsers' => $normalUsers
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->create($request->validated());
        $this->taskService->updateUserTasksCount($task->assignee);
        return redirect()->route('admin.tasks.index')->withSuccess('Data Saved Successfully');
    }
}

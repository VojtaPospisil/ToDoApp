<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Services\FrontServices\TaskService;
use App\Status;
use App\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    private $taskService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskService $taskService)
    {
        $this->middleware('auth:sanctum');
        $this->taskService = $taskService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        return $this->taskService->index();
    }

    /**
     * @param int $id
     * @return TaskResource
     */
    public function detail(int $id)
    {
        return new TaskResource(Task::with([
                'userCreated:id,name',
                'status:id,name',
                'category:id,name',
                'mainCategory:id,name',
                'comment',
            ])
            ->findOrFail($id));
    }

    /**
     * @param int $id
     * @return TaskResource
     * @throws \Exception
     */
    public function editStatus(Task $task)
    {
        return $this->taskService->editStatus($task);
    }
}

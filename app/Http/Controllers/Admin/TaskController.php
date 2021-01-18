<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Event\TaskCreated;
use App\Http\Requests\FilterTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\MainCategory;
use App\Services\AdminServices\TaskService;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->middleware('auth');
        $this->taskService = $taskService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.task.index');
    }

    public function jsonIndex(FilterTaskRequest $request)
    {
        abort_if(Gate::denies('is_admin', $request->user()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = $this->taskService->getFilteredTask($request);

        return (new TaskResource($tasks))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        abort_if(Gate::denies('is_admin', auth()->user()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.task.create');
    }

    /**
     * @param TaskRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(TaskRequest $request)
    {
        abort_if(Gate::denies('is_admin', $request->user()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task = $this->taskService->storeTask($request);

        event(new TaskCreated($task));

        return response($task, 201);
    }

    /**
     * @param int $id
     * @param int|null $commentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id, int $commentId = null)
    {
        abort_if(Gate::denies('is_admin', auth()->user()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task = $this->taskService->getTaskDetails($id);

        return view('admin.task.detail', compact('task', 'commentId'));
    }


    /**
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(Task $task)
    {
        abort_if(Gate::denies('is_admin', auth()->user()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            $mainCategories = MainCategory::getMainCategoryFormData();
            $categories = Category::getCategoryFormData();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return view('task.form', compact('task', 'mainCategories', 'categories'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, Task $task)
    {
        abort_if(Gate::denies('is_admin', $request->user()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task = $this->taskService->updateTask($request, $task);

        return response($task, 201);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        abort_if(Gate::denies('is_admin', auth()->user()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return response($task, 200);
    }
}

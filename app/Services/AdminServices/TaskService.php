<?php

namespace App\Services\AdminServices;

use App\Category;
use App\Comment;
use App\Http\Requests\FilterTaskRequest;
use App\Http\Requests\TaskRequest;
use App\MainCategory;
use App\Repository\Admin\TaskRepository;
use App\Task;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class TaskService
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getFilteredTask(FilterTaskRequest $request)
    {
        if (count($request->except('page')) > 0) {
            $textSearch = array_filter($request->only([
                'title',
                'description'
            ]));

            $dateSearch = array_filter($request->only([
                'dueDateFrom',
                'dueDateTo'
            ]));

            try {
                $tasks = Task::when(count($textSearch) > 0, function ($query) use ($textSearch) {
                    foreach ($textSearch as $column => $value) {
                        $query->Where($column, 'LIKE', '%' . $value . '%');
                    }
                })->when(\request('mainCategory', '') != null, function ($query) use ($request) {
                    $query->where('main_category_id', '=', (int) $request->mainCategory);
                })->when(\request('category', '') != null, function ($query) use ($request) {
                    $query->where('category_id', '=', (int) $request->category);
                })->when(count($dateSearch) > 0, function ($query) use ($dateSearch) {
                    $this->taskRepository->filterDate($query, $dateSearch);
                })->when(\request('status', '') != null, function ($query) use ($request) {
                    $query->where('status_id', '=', (int) $request->status);
                })->when(\request('user', '') != null, function ($query) use ($request) {
                    $query->where('user_id', '=', (int) $request->user);
                })->with([
                    'userCreated:id,name',
                    'status:id,name',
                    'userAssigned:id,name',
                    'category:id,name',
                    'mainCategory:id,name'
                ])->paginate(5);
            } catch (\Exception $exception) {
                throw new \Exception($exception->getMessage());
            }
        } else {
            $tasks = $this->taskRepository->getTaskQueryWithRelationships()->paginate(5);
        }

        return $tasks;
    }

    public function storeTask(TaskRequest $request)
    {
        try {
            $task = new Task();
            $task->fill($request->only('title', 'description', 'due_date'));
            $task->mainCategory()->associate(MainCategory::findOrFail($request->main_category));
            $task->userAssigned()->associate(User::findOrFail($request->user_id));
            $task->userCreated()->associate($request->user());
            $task->save();

            $task->category()->attach(Category::findOrFail($request->category));
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $task;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getTaskDetails(int $id)
    {
        return $this->taskRepository->getTaskQueryWithRelationships()
            ->with('comment')
            ->findOrFail($id);
    }

    public function updateTask(Request $request, Task $task)
    {
        $attributesArray = array("title", "description");
        $attribute = $request->attribute;
        $value = $request->newValue;

        try {
            if (in_array($attribute, $attributesArray)) {
                $task->fill($request->all());
            } else {
                switch ($request->attribute) {
                    case 'main_category':
                        $mainCategory = MainCategory::findOrFail((int) $value);
                        $task->mainCategory()->associate($mainCategory);
                        break;
                    case 'category':
                        $category = Category::findOrFail((int) $value);
                        $task->category()->updateExistingPivot($task->id, array($category), $category);
                        break;
                }
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $task;
    }
}

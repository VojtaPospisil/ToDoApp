<?php

namespace App\Services\FrontServices;

use App\Http\Resources\TaskResource;
use App\Status;
use App\Task;

class TaskService
{

    public function index()
    {
        try {
            $usersTask = auth()->user()->tasks()->get()->groupBy('status_id');

            return response()->json([
                'planned' => $usersTask[Status::PLANNED] ?? array(),
                'inProgress' => $usersTask[Status::INPROGRES] ?? array(),
                'finished' => $usersTask[Status::FINISHED] ?? array(),
                'unfinished' => $usersTask[Status::UNFINISHED] ?? array(),
            ], 200);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function editStatus(Task $task)
    {
        try {
            switch ($task->status) {
                case Status::PLANNED:
                    $task->setStatus(Status::INPROGRES);
                    break;
                case Status::INPROGRES:
                    $task->setStatus(Status::FINISHED);
                    break;
            }
//            $task->save();

            return new TaskResource($task);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}

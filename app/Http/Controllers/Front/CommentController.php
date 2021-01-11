<?php

namespace App\Http\Controllers\Front;

use App\Comment;
use App\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->only('comment'), [
                'comment' => 'required|min:3|max:255'
            ]);
            abort_if($validator->fails(), Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());

//            $parent = $request->parentId ? Comment::findOrFail($request->parentId) : null;
            $parent = $request->parentId ? Comment::findOrFail(1) : null;
            $task = Task::findOrFail($request->taskId);
            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->task()->associate($task);
            $comment->parent()->associate($parent);
            $comment->save();

            return response()->json([
                'comment' => $comment,
            ], 200);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}

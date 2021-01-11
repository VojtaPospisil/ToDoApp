<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Returns all unseen comments
     *
     * @return CommentResource
     */
    public function commentsJson()
    {
        return new CommentResource(Comment::NotSeenComments(true)->get());
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function setSeen(Comment $comment) {
        $comment->setSeen();
        $comment->save();

        return response(null, Response::HTTP_ACCEPTED);
    }
}

<?php

namespace App\Http\Controllers;

use App\Service\CommentsService;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public CommentsService $commentsService;

    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }

    public function index(Request $request)
    {
        return $this->commentsService->showComments($request);
    }
    public function store(Request $request)
    {
        return $this->commentsService->postComment($request);
    }
    public function destroy(string $id)
    {
        $comment = $this->commentsService->deleteComment($id);
        return $comment;
    }

}

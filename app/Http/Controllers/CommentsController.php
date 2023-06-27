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

    public function store(Request $request)
    {
        $comments = $this->commentsService->storeComments($request);
        
        return $comments;
    }

}

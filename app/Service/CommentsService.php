<?php

namespace App\Service;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsService {

    public function showComments() {
      $comments = Comment::with('user')->get();

        return $comments;
      }
    
      public function postComment(Request $request) {
        $request->validate([
          'body' => 'required|min:1|max:255'
        ]);
    
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = $request->user_id;
        $comment->gallery_id = $request->gallery_id;
        $comment->save();
    
        return $comment;
      }
    
      public function deleteComment($id)
      {
          Comment::destroy($id);
      }
}
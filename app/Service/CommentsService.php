<?php

namespace App\Service;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsService {

        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeComments(Request $request)
    {
        if(!Auth::check()) {
            return redirect('/galleries/' . $request->gallery_id)->withErrors('Only authenticated user can post comments');
        }

        $request->validate([
            'body' => 'required|min:2|max:1000|string',
            'gallery_id' => 'required|exists:galleries,id'
        ]);

        $gallery = Gallery::with('comments')->find($request->gallery_id);

        $user = User::find(Auth::user()->id);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->gallery()->associate($gallery);
        $comment->user()->associate($user);
        $comment->save();

        return $comment;

        return redirect('/galleries/' . $request->gallery_id)->with('status', 'Comment successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
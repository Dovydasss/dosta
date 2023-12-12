<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'content' => 'required',
        'blog_post_id' => 'required|exists:blog_posts,id',
    ]);

    $comment = new Comment($validatedData);
    $comment->user_id = auth()->id(); 
    $comment->save();

    return back()->with('success', 'Comment added successfully.');
}

public function destroy(Comment $comment)
{
    $comment->delete();

    return back()->with('success', 'Comment deleted successfully.');
}



}

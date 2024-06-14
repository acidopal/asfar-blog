<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string|min:3', 
            'blog_post_id' => 'required', 
        ]);

        $comment = new Comment($validatedData);
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|min:3',
        ]);

        $comment->update($validatedData);

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

}

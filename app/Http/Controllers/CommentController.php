<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {

    }
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
    public function store(Request $request, Post $post)
    {
        $data = $request->validate(['body' => ['required', 'string', 'max:2500']]);

        Comment::create([
            ...$data,
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
        ]);

        return to_route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(Request $request, Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return to_route('posts.show', ['post' => $comment->post_id, 'page' => $request->query('page')]);
    }
}

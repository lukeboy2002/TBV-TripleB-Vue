<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CommentController extends Controller
{

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

        return redirect($post->showRoute())
            ->banner('Your comment has been added');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $data = $request->validate(['body' => ['required', 'string', 'max:2500']]);

        $comment->update($data);

        return redirect($comment->post->showRoute(['page' => $request->query('page')]))
            ->banner('Your comment has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return redirect($comment->post->showRoute(['page' => $request->query('page')]))
//            ->dangerBanner('Your comment has been deleted');
            ->banner('Your comment has been deleted');
    }
}

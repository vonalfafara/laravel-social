<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'post_id' => 'required|numeric',
            'body' => 'required|string'
        ]);

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $fields['post_id'],
            'body' => $fields['body']
        ]);

        return response($comment, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'body' => 'required|string'
        ]);

        $comment = Comment::find($id);

        $comment->update($request->all());

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::destroy($id);
        
        $response = [
            'message' => 'Comment deleted'
        ];

        return response($response, 200);
    }
}

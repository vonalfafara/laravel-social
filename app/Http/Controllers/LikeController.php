<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'post_id' => 'required|numeric'
        ]);

        $like = Like::create([
            'user_id' => auth()->user()->id,
            'post_id' => $fields['post_id']
        ]);

        return response($like, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Like::destroy($id);

        $response = [
            'message' => 'Post unliked'
        ];

        return response($response, 200);
    }
}

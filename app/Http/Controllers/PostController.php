<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Post;
use App\Models\Friend;
use App\Http\Resources\FeedResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $friends = Friend::select('friends_with')->where('user_id', auth()->user()->id)->get();

        $friendsFlat = [];

        foreach ($friends as $friend) {
            $friendsFlat[] = $friend->friends_with;
        }

        $friendsFlat[] = auth()->user()->id;

        return FeedResource::collection(Post::whereIn('user_id', $friendsFlat)->orderBy('created_at', 'desc')->get());
    }

    /**
     * Display a listing of the posts in profile.
     */

    public function getProfilePosts() {
        return FeedResource::collection(Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'body' => 'required|string',
            'media' => 'nullable|string'
        ]);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'body' => $fields['body'],
            'media' => $fields['media']
        ]);

        return response($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Post::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'body' => 'required|string',
            'media' => 'nullable|string'
        ]);

        $post = Post::find($id);

        $post->update([
            'body' => $fields['body'],
            'media' => $fields['media'] ? $fields['media'] : $post->media
        ]);

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);

        $response = [
            'message' => 'Post deleted'
        ];

        return response($response, 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Http\Resources\FriendResource;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FriendResource::collection(Friend::where('user_id', auth()->user()->id)->get()); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Friend::where('user_id', $id)->get(); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Friend::destroy($id);

        $response = [
            'message' => 'Unfriended'
        ];

        return response($response, 200);
    }
}

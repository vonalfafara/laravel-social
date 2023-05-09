<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentResource;
use App\Models\Like;

class FeedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = $this->user->first_name . ' ' . $this->user->last_name;
        $userLiked = Like::where(
            [
                ['post_id', '=', $this->id],
                ['user_id', '=', auth()->user()->id]
            ]
        )->first();

        return [
            'id' => $this->id,
            'body' => $this->body,
            'media' => $this->media,
            'created_at' => $this->created_at,
            'user' => [
                'id' => $this->user->id,
                'name' => $name,
                'profile_picture' => $this->user->profile_picture
            ],
            'comments' => CommentResource::collection($this->comments),
            'likes' => $this->likes->count(),
            'isLiked' => $userLiked ? $userLiked->id : false
        ];
    }
}

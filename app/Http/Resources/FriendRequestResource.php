<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = $this->user->first_name . ' ' . $this->user->last_name;
        return [
            'id' => $this->id,
            'user' => $name,
            'profile_picture' => $this->user->profile_picture
        ];
    }
}

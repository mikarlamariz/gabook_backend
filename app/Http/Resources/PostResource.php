<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "text" => $this->text,
            "user_id" => $this->user_id,
            "book" => $this->book,
            "created_at" => $this->created_at,
            "like_count" => $this->like_count,
            "user" => $this->user
        ];
    }
}

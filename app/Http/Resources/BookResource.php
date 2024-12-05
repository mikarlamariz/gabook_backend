<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "title" => $this->title,
            "sinopse" => $this->sinopse,
            "release_year" => $this->release_year,
            "evaluation_average" => $this->evaluation_average,
            "cover" => $this->cover,
            "genre_id" => $this->genre_id,
            "author" => $this->author
        ];
    }
}

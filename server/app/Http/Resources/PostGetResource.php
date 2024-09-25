<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostGetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'published_at' => $this->published_at,
            'slug' => $this->slug,
            'imageUrl' => $this->imageUrl,
            'status' => $this->status,
            'tags' => $this->tags,
            'categories' => $this->categories,
            'user' => $this->user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

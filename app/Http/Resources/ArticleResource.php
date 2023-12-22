<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'short_description' => $this->short_description,
            'image' => asset($this->image),
            'created_at' => $this->created_at->format('d.m.Y'),
            'updated_at' => $this->updated_at->format('d.m.Y'),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}

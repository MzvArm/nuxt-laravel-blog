<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// Resource отвечает за формат API-ответа
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'author' => $this->author,
            'topic' => $this->topic,
            'content' => $this->content,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
        ];
    }
}
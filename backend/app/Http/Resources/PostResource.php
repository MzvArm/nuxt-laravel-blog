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
            'content' => $this->content,

            // Отдаём дату в удобном формате
            'created_at' => $this->created_at,
        ];
    }
}
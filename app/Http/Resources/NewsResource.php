<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'date_created_at' => $this->created_at->toDateString(),
            'author_name' => $this->author->name,
            'slug' => $this->slug,
            'title_ru' => $this->title_ru,
            'text_ru' => $this->text_ru,
            'title_by' => $this->title_by,
            'text_by' => $this->text_by,
            'title_en' => $this->title_en,
            'text_en' => $this->text_en
        ];
    }
}

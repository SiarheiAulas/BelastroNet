<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'storage_link' => $this->storage_link,
            'title_ru' => $this->title_ru,
            'description_ru' => $this->description_ru,
            'title_by' => $this->title_by,
            'description_by' => $this->description_by,
            'title_en' => $this->title_en,
            'description_en' => $this->description_en
        ];
    }
}

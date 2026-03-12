<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
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
            'url' => $this->url,
            'title_ru' => $this->title_ru,
            'description_ru' => $this->description_ru,
            'title_by' => $this->title_by,
            'description_by' => $this->description_by,
            'title_en' => $this->title_en,
            'description_en' => $this->description_en
        ];
    }
}

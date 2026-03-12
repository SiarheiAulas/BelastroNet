<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'author_id' => User::factory(),
            'storage_link' => '/storage/documents/' . fake()->uuid() . fake()->randomElement(['.pdf','.txt','docx']),
            'title_ru' => fake()->sentence(),
            'description_ru' => fake()->paragraph(),
            'title_by' => fake()->sentence(),
            'description_by' => fake()->paragraph(),
            'title_en' => fake()->sentence(),
            'description_en' => fake()->paragraph()
        ];
    }
}

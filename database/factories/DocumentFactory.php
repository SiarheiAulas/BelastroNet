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
            'title' => fake()->sentence(),
            'storage_link' => '/storage/documents/' . fake()->uuid() . fake()->randomElement(['.pdf','.txt','docx']),
            'description' => fake()->paragraph()
        ];
    }
}

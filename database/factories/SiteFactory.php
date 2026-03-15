<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'author_id' => User::factory(),
            'type' => fake()->randomElement(['belastro','other','gov','com','youtube','tg','soc','baf']),
            'url'=> fake()->unique()->url(),
            'author_ru' => fake()->name(), 
            'title_ru'=> fake()->sentence(),
            'description_ru' => fake()->paragraph(),
            'author_by' => fake()->name(), 
            'title_by'=> fake()->sentence(),
            'description_by' => fake()->paragraph(),
            'author_en' => fake()->name(), 
            'title_en'=> fake()->sentence(),
            'description_en' => fake()->paragraph()
        ];
    }
}

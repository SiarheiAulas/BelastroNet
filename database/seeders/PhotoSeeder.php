<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photo;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Photo::create([
            'author_id'=>1,
            'type' => 'landscapes',
            'storage_link'=>'./img/test_example_1.jpg',
            'title_ru'=>'photo1',
            'description_ru'=>'test_photo_1',
            'title_by'=>'photo1',
            'description_by'=>'test_photo_1',
            'title_en'=>'photo1',
            'description_en'=>'test_photo_1',
        ]);

        Photo::factory()->count(5)->create(['author_id' => 2]);

    }
}

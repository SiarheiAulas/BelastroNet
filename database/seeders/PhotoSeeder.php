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
            'title'=>'photo1',
            'type' => 'landscapes',
            'description'=>'test_photo_1',
            'storage_link'=>'./img/test_example_1.jpg'
        ]);

        Photo::factory()->count(5)->create(['author_id' => 2]);

    }
}

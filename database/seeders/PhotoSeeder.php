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
            'author_id'=>'1',
            'title'=>'photo1',
            'description'=>'test_photo_1',
            'storage_link'=>'./img/test_example_1.jpg'
        ]);

        Photo::create([
            'author_id'=>'1',
            'title'=>'photo2',
            'description'=>'test_photo_2',
            'storage_link'=>'./img/test_example_2.jpg'
        ]);
    }
}

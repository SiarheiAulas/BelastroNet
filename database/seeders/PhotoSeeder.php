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
            'type' => 'landscapes',
            'description'=>'test_photo_1',
            'storage_link'=>'./img/test_example_1.jpg'
        ]);

        Photo::create([
            'author_id'=>'2',
            'title'=>'photo2',
            'type' => 'deepsky',
            'description'=>'test_photo_2',
            'storage_link'=>'./img/test_example_2.jpg'
        ]);

        Photo::create([
            'author_id'=>'1',
            'title'=>'photo3',
            'type' => 'landscapes',
            'description'=>'test_photo_3',
            'storage_link'=>'./img/test_example_3.jpg'
        ]);

        Photo::create([
            'author_id'=>'2',
            'title'=>'photo4',
            'type' => 'deepsky',
            'description'=>'test_photo_4',
            'storage_link'=>'./img/test_example_4.jpg'
        ]);

        Photo::create([
            'author_id'=>'1',
            'title'=>'photo5',
            'type' => 'landscapes',
            'description'=>'test_photo_5',
            'storage_link'=>'./img/test_example_5.jpg'
        ]);

        Photo::create([
            'author_id'=>'2',
            'title'=>'photo6',
            'type' => 'deepsky',
            'description'=>'test_photo_6',
            'storage_link'=>'./img/test_example_6.jpg'
        ]);

        Photo::create([
            'author_id'=>'1',
            'title'=>'photo7',
            'type' => 'landscapes',
            'description'=>'test_photo_7',
            'storage_link'=>'./img/test_example_7.jpg'
        ]);

        Photo::create([
            'author_id'=>'2',
            'title'=>'photo8',
            'type' => 'deepsky',
            'description'=>'test_photo_8',
            'storage_link'=>'./img/test_example_8.jpg'
        ]);
    }
}

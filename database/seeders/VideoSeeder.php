<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'author_id'=>'1',
            'title'=>'video1',
            'type' =>'events',
            'description'=>'test_video_1',
            'storage_link'=>'./movie/test_example_1.mp4'
        ]);

        Video::create([
            'author_id'=>'2',
            'title'=>'video2',
            'type' =>'solar_system',
            'description'=>'test_video_2',
            'storage_link'=>'./movie/test_example_2.mp4'
        ]);

        Video::create([
            'author_id'=>'1',
            'title'=>'video3',
            'type' =>'events',
            'description'=>'test_video_3',
            'storage_link'=>'./movie/test_example_3.mp4'
        ]);

        Video::create([
            'author_id'=>'1',
            'title'=>'video4',
            'type' =>'solar_system',
            'description'=>'test_video_4',
            'storage_link'=>'./movie/test_example_4.mp4'
        ]);
        Video::create([
            'author_id'=>'2',
            'title'=>'video5',
            'type' =>'events',
            'description'=>'test_video_5',
            'storage_link'=>'./movie/test_example_5.mp4'
        ]);

        Video::create([
            'author_id'=>'1',
            'title'=>'video6',
            'type' =>'solar_system',
            'description'=>'test_video_6',
            'storage_link'=>'./movie/test_example_6.mp4'
        ]);
    }
}

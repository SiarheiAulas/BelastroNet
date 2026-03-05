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
            'description'=>'test_video_1',
            'storage_link'=>'./movie/test_example_1.mp4'
        ]);

        Video::create([
            'author_id'=>'1',
            'title'=>'video2',
            'description'=>'test_video_2',
            'storage_link'=>'./movie/test_example_2.mp4'
        ]);
    }
}

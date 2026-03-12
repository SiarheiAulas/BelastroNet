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
            'author_id'=>1,
            'type' =>'events',
            'storage_link'=>'./movie/test_example_1.mp4',
            'title_ru'=>'video1',
            'description_ru'=>'test_video_1',
            'title_by'=>'video1',
            'description_by'=>'test_video_1',
            'title_en'=>'video1',
            'description_en'=>'test_video_1',
        ]);

        Video::factory()->count(5)->create(['author_id' => 2]);
    }
}

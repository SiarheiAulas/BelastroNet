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
            'title'=>'video1',
            'type' =>'events',
            'description'=>'test_video_1',
            'storage_link'=>'./movie/test_example_1.mp4'
        ]);

        Video::factory()->count(5)->create(['author_id' => 2]);
    }
}

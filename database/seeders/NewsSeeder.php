<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'author_id'=>1,
            'slug'=>'test_news_1',
            'title_ru'=>'news1',
            'text_ru'=>'example news text 1',
            'title_by'=>'news1',
            'text_by'=>'example news text 1',
            'title_en'=>'news1',
            'text_en'=>'example news text 1'
        ]);

        News::factory()->count(5)->create(['author_id' => 1]);

    }
}

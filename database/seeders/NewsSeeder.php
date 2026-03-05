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
            'author_id'=>'1',
            'title'=>'news1',
            'slug'=>'test_news_1',
            'text'=>'example news text 1'
        ]);

        News::create([
            'author_id'=>'1',
            'title'=>'news2',
            'slug'=>'test_news_2',
            'text'=>'example news text 2'
        ]);
    }
}

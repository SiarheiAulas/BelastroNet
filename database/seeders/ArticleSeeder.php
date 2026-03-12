<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'author_id'=>1,
            'type'=>'misc',
            'slug'=>'test_article_1',
            'title_ru'=>'article1',
            'text_ru'=>'lorem ipsum dolorem sit amet',
            'title_by'=>'article1',
            'text_by'=>'lorem ipsum dolorem sit amet',
            'title_en'=>'article1',
            'text_en'=>'lorem ipsum dolorem sit amet'
        ]);

        Article::factory()->count(5)->create(['author_id' => 1]);
    }
}

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
            'title'=>'article1',
            'slug'=>'test_article_1',
            'text'=>'lorem ipsum dolorem sit amet'
        ]);

        Article::factory()->count(5)->create(['author_id' => 1]);
    }
}

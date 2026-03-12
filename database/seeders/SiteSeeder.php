<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Site::create([
            'author_id'=>1,
            'url'=>'https://example1.belastro.net',
            'author_ru'=>'test_author',
            'title_ru'=>'site_1',
            'description_ru'=>'lorem ipsum example 1',
            'author_by'=>'test_author',
            'title_by'=>'site_1',
            'description_by'=>'lorem ipsum example 1',
            'author_en'=>'test_author',
            'title_en'=>'site_1',
            'description_en'=>'lorem ipsum example 1'
        ]);
        
        Site::factory()->count(5)->create(['author_id' => 1]);

    }
}

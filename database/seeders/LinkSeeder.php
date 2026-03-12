<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Link::create([
            'author_id'=>1,
            'url'=>'http://example1.com',
            'title_ru'=>'external_site_1',
            'description_ru'=>'lorem ipsum example 1',
            'title_by'=>'external_site_1',
            'description_by'=>'lorem ipsum example 1',
            'title_en'=>'external_site_1',
            'description_en'=>'lorem ipsum example 1'
        ]);

        Link::factory()->count(5)->create(['author_id' => 1]);

    }
}

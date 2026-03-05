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
            'author_id'=>'1',
            'author'=>'test_author',
            'title'=>'site_1',
            'url'=>'example1.belastro.net',
            'description'=>'lorem ipsum example 1'
        ]);

        Site::create([
            'author_id'=>'1',
            'author'=>'test_author',
            'title'=>'site_2',
            'url'=>'example2.belastro.net',
            'description'=>'lorem ipsum example 2'
        ]);
    }
}

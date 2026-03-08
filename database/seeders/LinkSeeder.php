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
            'title'=>'external_site_1',
            'url'=>'http://example1.com',
            'description'=>'lorem ipsum example 1'
        ]);

        Link::create([
            'author_id'=>1,
            'title'=>'external_site_2',
            'url'=>'http://example2.com',
            'description'=>'lorem ipsum example 2'
        ]);
    }
}

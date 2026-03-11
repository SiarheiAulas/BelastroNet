<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::create([
            'author_id'=>1,
            'title'=>'document_1',
            'description'=>'test document 1',
            'storage_link'=>'./doc/example.pdf'
        ]);

        Document::factory()->count(5)->create(['author_id' => 2]);

    }
}
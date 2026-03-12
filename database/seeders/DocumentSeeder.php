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
            'storage_link'=>'./doc/example.pdf',
            'title_ru'=>'document_1',
            'description_ru'=>'test document 1',
            'title_by'=>'document_1',
            'description_by'=>'test document 1',
            'title_en'=>'document_1',
            'description_en'=>'test document 1',
        ]);

        Document::factory()->count(5)->create(['author_id' => 2]);

    }
}
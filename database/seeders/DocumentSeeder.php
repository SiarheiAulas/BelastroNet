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
            'author_id'=>'1',
            'title'=>'document_1',
            'storage_link'=>'./doc/example.pdf']);

        Document::create([
            'author_id'=>'1',
            'title'=>'document_2',
            'storage_link'=>'./doc/example2.pdf']);

    }
}

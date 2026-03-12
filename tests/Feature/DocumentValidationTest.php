<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Document;

class DocumentValidationTest extends TestCase
{
   use RefreshDatabase;

   public function test_title_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test1.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            //'title_ru' => 'test_title_1',
            'description_ru' => 'test description text 1',
            'title_by' => 'test_title_1',
            'description_by' => 'test description text 1',
            'title_en' => 'test_title_1',
            'description_en' => 'test description text 1',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title_ru');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test2.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title_ru' => 123,
            'description_ru' => 'test description text 2',
            'title_by' => 'test_title_1',
            'description_by' => 'test description text 2',
            'title_en' => 'test_title_1',
            'description_en' => 'test description text 2',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title_ru');
    }
    
    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test3.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title_ru' => 'test_title_1',
            //'description_ru' => 'test description text 3',
            'title_by' => 'test_title_1',
            'description_by' => 'test description text 3',
            'title_en' => 'test_title_1',
            'description_en' => 'test description text 3',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description_ru');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test4.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title_ru' => 'test_title_1',
            'description_ru' => 123,
            'title_by' => 'test_title_1',
            'description_by' => 'test description text 3',
            'title_en' => 'test_title_1',
            'description_en' => 'test description text 3',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description_ru');
    }

    public function test_file_required_post(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test5.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title_ru' => 'test_title_1',
            'description_ru' => 'test description text 4',
            'title_by' => 'test_title_1',
            'description_by' => 'test description text 4',
            'title_en' => 'test_title_1',
            'description_en' => 'test description text 4',
            //'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }

    public function test_file_not_required_put(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $document = Document::factory()->create();
        $id = $document->id;
        $file = UploadedFile::fake()->create('test6.pdf');
        $response = $this->actingAs($user)->put("/documents/{$id}", [
            'title_ru' => 'test_title_5',
            'description_ru' => 'test description text 5',
            'title_by' => 'test_title_5',
            'description_by' => 'test description text 5',
            'title_en' => 'test_title_5',
            'description_en' => 'test description text 5',
            //'file' => $file
            ]);

        $response->assertStatus(302);
    }

    public function test_file_max_size(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file_size = 20000;
        $file = UploadedFile::fake()->create('test7.pdf', $file_size);
        $response = $this->actingAs($user)->post('/documents', [
            'title_ru' => 'test_title_1',
            'description_ru' => 'test description text 6',
            'title_by' => 'test_title_1',
            'description_by' => 'test description text 6',
            'title_en' => 'test_title_1',
            'description_en' => 'test description text 6',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }

    public function test_file_mimes(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test8.pdf', 20000, 'application/ecmascript');
        $response = $this->actingAs($user)->post('/documents', [
            'title_ru' => 'test_title_1',
            'description_ru' => 'test description text 7',
            'title_by' => 'test_title_1',
            'description_by' => 'test description text 7',
            'title_en' => 'test_title_1',
            'description_en' => 'test description text 7',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }
}

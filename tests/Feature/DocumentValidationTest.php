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
            //'title' => 'test_title_1',
            'description' => 'test description text 1',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test2.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title' => 123,
            'description' => 'test description text 2',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title');
    }
    
    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test3.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title' => 'test_title_1',
            //'description' => 'test description text 3',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test4.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title' => 'test_title_1',
            'description' => 123,
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_file_required_post(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test5.pdf');
        $response = $this->actingAs($user)->post('/documents', [
            'title' => 'test_title_1',
            'description' => 'test description text 4',
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
            'title' => 'test_title_1',
            'description' => 'test description text 5',
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
            'title' => 'test_title_1',
            'description' => 'test description text 6',
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
            'title' => 'test_title_1',
            'description' => 'test description text 7',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }
}

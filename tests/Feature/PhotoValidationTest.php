<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Photo;

class PhotoValidationTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_type_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->image('photo1.jpg');
        $response = $this->actingAs($user)->post('/photos', [
            //'type' => 'landscapes',
            'title' => 'test_title_1',
            'description' => 'test description 1',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('type');
    }

    public function test_type_in(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->image('photo2.jpg');
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'test',
            'title' => 'test_title_2',
            'description' => 'test description 2',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('type');
    }

    public function test_title_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->image('test3.jpg');
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'landscapes',
            //'title' => 'test_title_3',
            'description' => 'test description text 3',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->image('test4.jpg');
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'landscapes',
            'title' => 123,
            'description' => 'test description text 4',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title');
    }
    
    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->image('test5.jpg');
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'landscapes',
            'title' => 'test_title_5',
            //'description' => 'test description text 5',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->image('test6.jpg');
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'landscapes',
            'title' => 'test_title_6',
            'description' => 123,
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_file_required_post(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->image('test7.jpg');
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'landscapes',
            'title' => 'test_title_7',
            'description' => 'test description text 7',
            //'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }

    public function test_file_not_required_put(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $file = UploadedFile::fake()->image('test8.jpg');
        $response = $this->actingAs($user)->put("/photos/{$id}", [
            'title' => 'test_title_8',
            'description' => 'test description text 8',
            //'file' => $file
            ]);

        $response->assertStatus(302);
    }

    public function test_file_max_size(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file_size = 60000;
        $file = UploadedFile::fake()->image('test9.jpg',)->size($file_size);
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'landscapes',
            'title' => 'test_title_9',
            'description' => 'test description text 9',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }

    public function test_file_mimes(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test10.jpg', 800, 'text/plain');
        $response = $this->actingAs($user)->post('/photos', [
            'type' => 'landscapes',
            'title' => 'test_title_10',
            'description' => 'test description text 10',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    } 
}

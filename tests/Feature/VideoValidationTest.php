<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Video;

class VideoValidationTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_type_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('video1.avi');
        $response = $this->actingAs($user)->post('/videos', [
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
        $file = UploadedFile::fake()->create('video2.avi');
        $response = $this->actingAs($user)->post('/videos', [
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
        $file = UploadedFile::fake()->create('test3.avi');
        $response = $this->actingAs($user)->post('/videos', [
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
        $file = UploadedFile::fake()->create('test4.avi');
        $response = $this->actingAs($user)->post('/videos', [
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
        $file = UploadedFile::fake()->create('test5.avi');
        $response = $this->actingAs($user)->post('/videos', [
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
        $file = UploadedFile::fake()->create('test6.avi');
        $response = $this->actingAs($user)->post('/videos', [
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
        $file = UploadedFile::fake()->create('test7.avi');
        $response = $this->actingAs($user)->post('/videos', [
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
        $video = Video::factory()->create();
        $id = $video->id;
        $file = UploadedFile::fake()->create('test8.avi');
        $response = $this->actingAs($user)->put("/videos/{$id}", [
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
        $file = UploadedFile::fake()->create('test9.avi', $file_size);
        $response = $this->actingAs($user)->post('/videos', [
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
        $file = UploadedFile::fake()->create('test10.avi', 800, 'text/plain');
        $response = $this->actingAs($user)->post('/videos', [
            'title' => 'test_title_10',
            'description' => 'test description text 10',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }
}

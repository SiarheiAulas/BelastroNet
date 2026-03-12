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
            'title_ru' => 'test_title_1',
            'description_ru' => 'test description 1',
            'title_by' => 'test_title_1',
            'description_by' => 'test description 1',
            'title_en' => 'test_title_1',
            'description_en' => 'test description 1',
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
            'title_ru' => 'test_title_2',
            'description_ru' => 'test description 2',
            'title_by' => 'test_title_2',
            'description_by' => 'test description 2',
            'title_en' => 'test_title_2',
            'description_en' => 'test description 2',
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
            //'title_ru' => 'test_title_3',
            'description_ru' => 'test description text 3',
            'title_by' => 'test_title_3',
            'description_by' => 'test description text 3',
            'title_en' => 'test_title_3',
            'description_en' => 'test description text 3',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title_ru');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test4.avi');
        $response = $this->actingAs($user)->post('/videos', [
            'type' => 'landscapes',
            'title_ru' => 123,
            'description_ru' => 'test description text 4',
            'title_by' => 'test_title_4',
            'description_by' => 'test description text 4',
            'title_en' => 'test_title_4',
            'description_en' => 'test description text 4',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('title_ru');
    }
    
    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test5.avi');
        $response = $this->actingAs($user)->post('/videos', [
            'type' => 'landscapes',
            'title_ru' => 'test_title_5',
            //'description_ru' => 'test description text 5',
            'title_by' => 'test_title_5',
            'description_by' => 'test description text 5',
            'title_en' => 'test_title_5',
            'description_en' => 'test description text 5',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description_ru');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test6.avi');
        $response = $this->actingAs($user)->post('/videos', [
            'type' => 'landscapes',
            'title_ru' => 'test_title_6',
            'description_ru' => 123,
            'title_by' => 'test_title_6',
            'description_by' => 'test description text 6',
            'title_en' => 'test_title_6',
            'description_en' => 'test description text 6',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('description_ru');
    }

    public function test_file_required_post(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $file = UploadedFile::fake()->create('test7.avi');
        $response = $this->actingAs($user)->post('/videos', [
            'type' => 'landscapes',
            'title_ru' => 'test_title_7',
            'description_ru' => 'test description text 7',
            'title_by' => 'test_title_7',
            'description_by' => 'test description text 7',
            'title_en' => 'test_title_7',
            'description_en' => 'test description text 7',
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
            'type' => 'landscapes',
            'title_ru' => 'test_title_8',
            'description_ru' => 'test description text 8',
            'title_by' => 'test_title_8',
            'description_by' => 'test description text 8',
            'title_en' => 'test_title_8',
            'description_en' => 'test description text 8',
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
            'type' => 'landscapes',
            'title_ru' => 'test_title_9',
            'description_ru' => 'test description text 9',
            'title_by' => 'test_title_9',
            'description_by' => 'test description text 9',
            'title_en' => 'test_title_9',
            'description_en' => 'test description text 9',
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
            'type' => 'landscapes',
            'title_ru' => 'test_title_10',
            'description_ru' => 'test description text 10',
            'title_by' => 'test_title_10',
            'description_by' => 'test description text 10',
            'title_en' => 'test_title_10',
            'description_en' => 'test description text 10',
            'file' => $file
            ]);

        $response->assertSessionHasErrors('file');
    }
}

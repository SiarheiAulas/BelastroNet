<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class VideoCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $video = UploadedFile::fake()->create('test1.avi');
        $response = $this->post('/videos',['type' => 'landscapes', 'title' => 'test_title_1', 'description' => 'lorem ipsum test description 1', 'file' => $video]);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $video = UploadedFile::fake()->create('test2.mp4');
        $response = $this->actingAs($user)->post('/videos',['type' => 'events', 'title' => 'test_title_2', 'description' => 'lorem ipsum test text 2', 'file' => $video]);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $video = UploadedFile::fake()->create('test3.mov');
        $response = $this->actingAs($admin)->post('/videos',['type' => 'misc', 'title' => 'test_title_3', 'description' => 'lorem ipsum test description 3', 'file' => $video]);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

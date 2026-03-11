<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Video;


class VideoAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_access_index(): void
    {
        $response = $this->get('/videos');

        $response->assertStatus(200);
    }

    public function test_guest_has_access_show(): void
    {
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->get("/videos/{$id}");

        $response->assertStatus(200);
    }

    public function test_guest_has_no_access_create(): void
    {
        $response = $this->get('/videos/create');

        $response->assertStatus(403);
    }

    public function test_guest_has_no_access_edit(): void
    {
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->get("/videos/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/videos');

        $response->assertStatus(200);
    }

    public function test_user_has_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->actingAs($user)->get("/videos/{$id}");

        $response->assertStatus(200);
    }

    public function test_user_has_access_create(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/videos/create');

        $response->assertStatus(200);
    }

    public function test_user_has_access_edit_self(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $video = Video::factory()->create(['author_id' => $user->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->get("/videos/{$id}/edit");

        $response->assertStatus(200);
    }

    public function test_user_has_no_access_edit_nonself(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $video = Video::factory()->create(['author_id' => $user2->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->get("/videos/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_admin_has_access_index(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/videos');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_show(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->actingAs($admin)->get("/videos/{$id}");

        $response->assertStatus(200);
    }

    public function test_admin_has_access_create(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/videos/create');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_edit(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->actingAs($admin)->get("/videos/{$id}/edit");

        $response->assertStatus(200);
    }
}

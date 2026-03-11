<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Photo;

class PhotoAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_access_index(): void
    {
        $response = $this->get('/photos');

        $response->assertStatus(200);
    }

    public function test_guest_has_access_show(): void
    {
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->get("/photos/{$id}");

        $response->assertStatus(200);
    }

    public function test_guest_has_no_access_create(): void
    {
        $response = $this->get('/photos/create');

        $response->assertStatus(403);
    }

    public function test_guest_has_no_access_edit(): void
    {
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->get("/photos/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/photos');

        $response->assertStatus(200);
    }

    public function test_user_has_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->actingAs($user)->get("/photos/{$id}");

        $response->assertStatus(200);
    }

    public function test_user_has_access_create(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/photos/create');

        $response->assertStatus(200);
    }

    public function test_user_has_access_edit_self(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $photo = Photo::factory()->create(['author_id' => $user->id]);
        $id = $photo->id;
        $response = $this->actingAs($user)->get("/photos/{$id}/edit");

        $response->assertStatus(200);
    }

    public function test_user_has_no_access_edit_nonself(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $photo = Photo::factory()->create(['author_id' => $user2->id]);
        $id = $photo->id;
        $response = $this->actingAs($user)->get("/photos/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_admin_has_access_index(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/photos');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_show(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->actingAs($admin)->get("/photos/{$id}");

        $response->assertStatus(200);
    }

    public function test_admin_has_access_create(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/photos/create');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_edit(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->actingAs($admin)->get("/photos/{$id}/edit");

        $response->assertStatus(200);
    }
}

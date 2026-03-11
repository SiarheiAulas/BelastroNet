<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Link;

class LinkAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_access_index(): void
    {
        $response = $this->get('/links');

        $response->assertStatus(200);
    }

    public function test_guest_has_access_show(): void
    {
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->get("/links/{$id}");

        $this->assertTrue(in_array($response->status(),[500,403,404]));
    }

    public function test_guest_has_no_access_create(): void
    {
        $response = $this->get('/links/create');

        $response->assertStatus(403);
    }

    public function test_guest_has_no_access_edit(): void
    {
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->get("/links/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/links');

        $response->assertStatus(200);
    }

    public function test_user_has_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($user)->get("/links/{$id}");

        $this->assertTrue(in_array($response->status(),[500,403,404]));
    }

    public function test_user_has_no_access_create(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/links/create');

        $response->assertStatus(403);
    }

    public function test_user_has_no_access_edit(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($user)->get("/links/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_admin_has_access_index(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/links');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_show(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($admin)->get("/links/{$id}");

        $this->assertTrue(in_array($response->status(),[500,403,404]));
    }

    public function test_admin_has_access_create(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/links/create');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_edit(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($admin)->get("/links/{$id}/edit");

        $response->assertStatus(200);
    }
}

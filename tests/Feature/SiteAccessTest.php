<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Site;

class SiteAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_access_index(): void
    {
        $response = $this->get('/sites');

        $response->assertStatus(200);
    }

    public function test_guest_has_no_access_show(): void
    {
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->get("/sites/{$id}");

        $this->assertTrue(in_array($response->status(),[500,403,404]));
    }

    public function test_guest_has_no_access_create(): void
    {
        $response = $this->get('/sites/create');

        $response->assertStatus(403);
    }

    public function test_guest_has_no_access_edit(): void
    {
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->get("/sites/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/sites');

        $response->assertStatus(200);
    }

    public function test_user_has_no_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($user)->get("/sites/{$id}");

        $this->assertTrue(in_array($response->status(),[500,403,404]));
    }

    public function test_user_has_no_access_create(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/sites/create');

        $response->assertStatus(403);
    }

    public function test_user_has_no_access_edit(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($user)->get("/sites/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_admin_has_access_index(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/sites');

        $response->assertStatus(200);
    }

    public function test_admin_has_no_access_show(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($admin)->get("/sites/{$id}");

        $this->assertTrue(in_array($response->status(),[500,403,404]));
    }

    public function test_admin_has_access_create(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/sites/create');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_edit(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($admin)->get("/sites/{$id}/edit");

        $response->assertStatus(200);
    }
}

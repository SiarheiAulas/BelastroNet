<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UsersAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access_index(): void
    {
        $response = $this->get('/users');
        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_guest_has_no_access_show(): void
    {
        $user = User::factory()->create();
        $id = $user->id;
        $response = $this->get("/users/{$id}");
        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_user_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/users');
        $response->assertStatus(200);
    }

    public function test_user_has_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $id = $user2->id;
        $response = $this->actingAs($user)->get("/users/{$id}");
        $response->assertStatus(200);
    }

    public function test_admin_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->get('/users');
        $response->assertStatus(200);
    }

    public function test_admin_has_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $user2 = User::factory()->create();
        $id = $user2->id;
        $response = $this->actingAs($user)->get("/users/{$id}");
        $response->assertStatus(200);
    }
}

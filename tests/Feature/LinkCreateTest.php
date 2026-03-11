<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LinkCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $response = $this->post('/links',['title' => 'test_title_1', 'url' => 'https://www.testlink1.com', 'description' => 'lorem ipsum test description text 1']);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->post('/links',['title' => 'test_title_2', 'url' => 'https://www.testlink2.com', 'description' => 'lorem ipsum  description text 2']);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->post('/links',['title' => 'test_title_3', 'url' => 'https://www.testlink3.com', 'description' => 'lorem test description text 3']);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SiteCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $response = $this->post('/sites',['title' => 'test_title_1', 'author' => 'Author1','url' => 'https://www.testsite1.com', 'description' => 'lorem ipsum test description text 1']);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->post('/sites',['title' => 'test_title_2', 'author' => 'Author2', 'url' => 'https://www.testsite2.com', 'description' => 'lorem ipsum  description text 2']);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->post('/sites',['title' => 'test_title_3', 'author' => 'Author3', 'url' => 'https://www.testsite3.com', 'description' => 'lorem test description text 3']);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

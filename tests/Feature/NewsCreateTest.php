<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class NewsCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $response = $this->post('/news',['title' => 'test_title_1', 'slug' => 'test_slug_1', 'text' => 'lorem_ipsum_test_text_1']);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->post('/news',['title' => 'test_title_2', 'slug' => 'test_slug_2', 'text' => 'lorem_ipsum_test_text_2']);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->post('/news',['title' => 'test_title_3', 'slug' => 'test_slug_3', 'text' => 'lorem_ipsum_test_text_3']);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

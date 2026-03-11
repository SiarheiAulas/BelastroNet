<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\News;

class NewsDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $news = News::factory()->create();
        $id = $news->id;
        $response = $this->delete("/news/{$id}");
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $news = News::factory()->create();
        $id = $news->id;
        $response = $this->actingAs($user)->delete("/news/{$id}");
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $news = News::factory()->create();
        $id = $news->id;
        $response = $this->actingAs($admin)->delete("/news/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

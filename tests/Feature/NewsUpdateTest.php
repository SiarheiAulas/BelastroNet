<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\News;

class NewsUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $news = News::factory()->create();
        $id = $news->id;
        $response = $this->put("/news/{$id}", ['title' => 'new_test_title_1', 'slug' => 'new_test_slug_1', 'text' => 'new_test_text_1']);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $news = News::factory()->create();
        $id = $news->id;
        $response = $this->actingAs($user)->put("/news/{$id}", ['title' => 'new_test_title_2', 'slug' => 'new_test_slug_2', 'text' => 'new_test_text_2']);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $news = News::factory()->create();
        $id = $news->id;
        $response = $this->actingAs($admin)->put("/news/{$id}", ['title' => 'new_test_title_3', 'slug' => 'new_test_slug_3', 'text' => 'new_test_text_3']);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

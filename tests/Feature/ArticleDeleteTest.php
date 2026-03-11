<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class ArticleDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->delete("/articles/{$id}");
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($user)->delete("/articles/{$id}");
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($admin)->delete("/articles/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

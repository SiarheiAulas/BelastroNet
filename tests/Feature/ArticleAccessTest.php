<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class ArticleAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_access_index(): void
    {
        $response = $this->get('/articles');

        $response->assertStatus(200);
    }

    public function test_guest_has_access_show(): void
    {
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->get("/articles/{$id}");

        $response->assertStatus(200);
    }

    public function test_guest_has_no_access_create(): void
    {
        $response = $this->get('/articles/create');

        $response->assertStatus(403);
    }

    public function test_guest_has_no_access_edit(): void
    {
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->get("/articles/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/articles');

        $response->assertStatus(200);
    }

    public function test_user_has_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($user)->get("/articles/{$id}");

        $response->assertStatus(200);
    }

    public function test_user_has_no_access_create(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/articles/create');

        $response->assertStatus(403);
    }

    public function test_user_has_no_access_edit(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($user)->get("/articles/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_admin_has_access_index(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/articles');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_show(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($admin)->get("/articles/{$id}");

        $response->assertStatus(200);
    }

    public function test_admin_has_access_create(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/articles/create');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_edit(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($admin)->get("/articles/{$id}/edit");

        $response->assertStatus(200);
    }
}

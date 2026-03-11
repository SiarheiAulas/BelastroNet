<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class ArticleValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_type_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            //'type' => 'tricks',
            'title' => 'test_title_1',
            'slug' => 'test_slug_1',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('type');
    }

    public function test_type_in(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'test',
            'title' => 'test_title_1',
            'slug' => 'test_slug_1',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('type');
    }

    public function test_title_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            //'title' => 'test_title_1',
            'slug' => 'test_slug_1',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'title' => 123,
            'slug' => 'test_slug_1',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('title');
    }
    
    public function test_slug_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'title' => 'test_title_1',
            //'slug' => 'test_slug_1',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_slug_alpha_dash(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'title' => 'test_title_1',
            'slug' => 'test)%^',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('slug');
    }
    
    public function test_slug_max(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'title' => 'test_title_1',
            'slug' => 'test_slug_1_test_slug_1_test_slug_1_test_slug_1_test_slug_1_test_slug_1',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('slug');
    }
    
    public function test_slug_unique(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $article = Article::create([
            'author_id' => $user->id,
            'type' => 'misc',
            'title' => 'test_title_0',
            'slug' => 'test_slug',
            'text' => 'test_text_0'
            ]);
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'title' => 'test_title_1',
            'slug' => 'test_slug',
            'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_text_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'title' => 'test_title_1',
            'slug' => 'test_slug_1',
            //'text' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('text');
    }

    public function test_text_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'title' => 'test_title_1',
            'slug' => 'test_slug_1',
            'text' => 123
            ]);

        $response->assertSessionHasErrors('text');
    }
}
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
            'slug' => 'test_slug_1',
            'title_ru' => 'test_title_1',
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('type');
    }

    public function test_type_in(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'test',
            'slug' => 'test_slug_1',
            'title_ru' => 'test_title_1',
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('type');
    }

    public function test_title_ru_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'slug' => 'test_slug_1',
            //'title_ru' => 'test_title_1',
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('title_ru');
    }

    public function test_title_ru_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'slug' => 'test_slug_1',
            'title_ru' => 123,
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('title_ru');
    }
    
    public function test_slug_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            //'slug' => 'test_slug_1',
            'title_ru' => 'test_title_1',
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
             ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_slug_alpha_dash(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'slug' => 'test)%^',
            'title_ru' => 'test_title_1',
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('slug');
    }
    
    public function test_slug_max(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'slug' => 'test_slug_1_test_slug_1_test_slug_1_test_slug_1_test_slug_1_test_slug_1',
            'title_ru' => 'test_title_1',
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
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
            'slug' => 'test_slug',
            'title_ru' => 'test_title_0',
            'text_ru' => 'test_text_0',
            'title_by' => 'test_title_0',
            'text_by' => 'test_text_0',
            'title_en' => 'test_title_0',
            'text_en' => 'test_text_0'
            ]);
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'slug' => 'test_slug',
            'title_ru' => 'test_title_1',
            'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_text_ru_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'slug' => 'test_slug_1',
            'title_ru' => 'test_title_1',
            //'text_ru' => 'test_text_1',
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('text_ru');
    }

    public function test_text_ru_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/articles', [
            'type' => 'tricks',
            'slug' => 'test_slug_1',
            'title_ru' => 'test_title_1',
            'text_ru' => 123,
            'title_by' => 'test_title_1',
            'text_by' => 'test_text_1',
            'title_en' => 'test_title_1',
            'text_en' => 'test_text_1'
            ]);

        $response->assertSessionHasErrors('text_ru');
    }
}
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\News;

class NewsValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_title_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
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
        $response = $this->actingAs($user)->post('/news', [
            'title' => 123,
            'slug' => 'test_slug_2',
            'text' => 'test_text_2'
            ]);

        $response->assertSessionHasErrors('title');
    }
    
    public function test_slug_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'title' => 'test_title_3',
            //'slug' => 'test_slug_3',
            'text' => 'test_text_3'
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_slug_alpha_dash(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'title' => 'test_title_4',
            'slug' => 'test)%^',
            'text' => 'test_text_4'
            ]);

        $response->assertSessionHasErrors('slug');
    }
    
    public function test_slug_max(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'title' => 'test_title_5',
            'slug' => 'test_slug_5_test_slug_5_test_slug_5_test_slug_5_test_slug_5_test_slug_5',
            'text' => 'test_text_5'
            ]);

        $response->assertSessionHasErrors('slug');
    }
    
    public function test_slug_unique(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $news = News::create([
            'author_id' => $user->id,
            'title' => 'test_title_0',
            'slug' => 'test_slug',
            'text' => 'test_text_0'
            ]);
        $response = $this->actingAs($user)->post('/news', [
            'title' => 'test_title_7',
            'slug' => 'test_slug',
            'text' => 'test_text_7'
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_text_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'title' => 'test_title_8',
            'slug' => 'test_slug_8',
            //'text' => 'test_text_8'
            ]);

        $response->assertSessionHasErrors('text');
    }

    public function test_text_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'title' => 'test_title_9',
            'slug' => 'test_slug_9',
            'text' => 123
            ]);

        $response->assertSessionHasErrors('text');
    }
}

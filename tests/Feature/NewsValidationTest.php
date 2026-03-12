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

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'slug' => 'test_slug_2',
            'title_ru' => 123,
            'text_ru' => 'test_text_2',
            'title_by' => 'test_title_2',
            'text_by' => 'test_text_2',
            'title_en' => 'test_title_2',
            'text_en' => 'test_text_2'
            ]);

        $response->assertSessionHasErrors('title_ru');
    }
    
    public function test_slug_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            //'slug' => 'test_slug_3',
            'title_ru' => 'test_title_3',
            'text_ru' => 'test_text_3',
            'title_by' => 'test_title_3',
            'text_by' => 'test_text_3',
            'title_en' => 'test_title_3',
            'text_en' => 'test_text_3'
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_slug_alpha_dash(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'slug' => 'test)%^',
            'title_ru' => 'test_title_4',
            'text_ru' => 'test_text_4',
            'title_by' => 'test_title_4',
            'text_by' => 'test_text_4',
            'title_en' => 'test_title_4',
            'text_en' => 'test_text_4'
            ]);

        $response->assertSessionHasErrors('slug');
    }
    
    public function test_slug_max(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'slug' => 'test_slug_5_test_slug_5_test_slug_5_test_slug_5_test_slug_5_test_slug_5',
            'title_ru' => 'test_title_5',
            'text_ru' => 'test_text_5',
            'title_by' => 'test_title_5',
            'text_by' => 'test_text_5',
            'title_en' => 'test_title_5',
            'text_en' => 'test_text_5'
            ]);

        $response->assertSessionHasErrors('slug');
    }
    
    public function test_slug_unique(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $news = News::create([
            'author_id' => $user->id,
            'slug' => 'test_slug',
            'title_ru' => 'test_title_0',
            'text_ru' => 'test_text_0',
            'title_by' => 'test_title_0',
            'text_by' => 'test_text_0',
            'title_en' => 'test_title_0',
            'text_en' => 'test_text_0'
            ]);

        $response = $this->actingAs($user)->post('/news', [
            'slug' => 'test_slug',
            'title_ru' => 'test_title_7',
            'text_ru' => 'test_text_7',
            'title_by' => 'test_title_7',
            'text_by' => 'test_text_7',
            'title_en' => 'test_title_7',
            'text_en' => 'test_text_7'
            ]);

        $response->assertSessionHasErrors('slug');
    }

    public function test_text_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'slug' => 'test_slug_8',
            'title_ru' => 'test_title_8',
            //'text_ru' => 'test_text_8',
            'title_by' => 'test_title_8',
            'text_by' => 'test_text_8',
            'title_en' => 'test_title_8',
            'text_en' => 'test_text_8'
            ]);

        $response->assertSessionHasErrors('text_ru');
    }

    public function test_text_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/news', [
            'slug' => 'test_slug_9',
            'title_ru' => 'test_title_9',
            'text_ru' => 123,
            'title_by' => 'test_title_9',
            'text_by' => 'test_text_9',
            'title_en' => 'test_title_9',
            'text_en' => 'test_text_9'
            ]);

        $response->assertSessionHasErrors('text_ru');
    }
}

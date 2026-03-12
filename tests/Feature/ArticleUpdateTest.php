<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class ArticleUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->put("/articles/{$id}", [
                                                'title_ru' => 'new_test_title_1',
                                                'text_ru' => 'new_test_text_1',
                                                'title_by' => 'new_test_title_1',
                                                'text_by' => 'new_test_text_1',
                                                'title_en' => 'new_test_title_1',
                                                'text_en' => 'new_test_text_1',
                                            ]);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($user)->put("/articles/{$id}", [
                                                                'title_ru' => 'new_test_title_2',
                                                                'text_ru' => 'new_test_text_2',
                                                                'title_by' => 'new_test_title_2',
                                                                'text_by' => 'new_test_text_2',
                                                                'title_en' => 'new_test_title_2',
                                                                'text_en' => 'new_test_text_2'
                                                            ]);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $article = Article::factory()->create();
        $id = $article->id;
        $response = $this->actingAs($admin)->put("/articles/{$id}", [
                                                                    'title_ru' => 'new_test_title_3',
                                                                    'text_ru' => 'new_test_text_3',
                                                                    'title_by' => 'new_test_title_3',
                                                                    'text_by' => 'new_test_text_3',
                                                                    'title_en' => 'new_test_title_3',
                                                                    'text_en' => 'new_test_text_3',
                                                                    ]);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ArticleCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/articles',[
                                            'author_id' => $user->id,
                                            'type' => 'misc',
                                            'slug' => 'test_slug_1',
                                            'title_ru' => 'test_title_1',
                                            'text_ru' => 'lorem_ipsum_test_text_1',
                                            'title_by' => 'test_title_1',
                                            'text_by' => 'lorem_ipsum_test_text_1',
                                            'title_en' => 'test_title_1',
                                            'text_en' => 'lorem_ipsum_test_text_1'
                                            ]);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->post('/articles',[
                                                            'author_id' => $user->id,
                                                            'type' => 'workshop',
                                                            'slug' => 'test_slug_2',
                                                            'text_ru' => 'lorem_ipsum_test_text_2',
                                                            'title_ru' => 'test_title_2',
                                                            'text_by' => 'lorem_ipsum_test_text_2',
                                                            'title_by' => 'test_title_2',
                                                            'text_en' => 'lorem_ipsum_test_text_2',
                                                            'title_en' => 'test_title_2',
                                                            ]);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->post('/articles',[
                                                            'author_id' => $admin->id,
                                                            'type' => 'workshop',
                                                            'slug' => 'test_slug_2',
                                                            'title_ru' => 'test_title_2',
                                                            'text_ru' => 'lorem_ipsum_test_text_2',
                                                            'title_by' => 'test_title_2',
                                                            'text_by' => 'lorem_ipsum_test_text_2',
                                                            'title_en' => 'test_title_2',
                                                            'text_en' => 'lorem_ipsum_test_text_2',
                                                        ]);

        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

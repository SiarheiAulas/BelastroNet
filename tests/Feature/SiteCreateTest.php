<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SiteCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $response = $this->post('/sites',[
                                        'url' => 'https://www.testsite1.com',
                                        'title_ru' => 'test_title_1',
                                        'author_ru' => 'Author1',
                                        'description_ru' => 'lorem ipsum test description text 1',
                                        'title_by' => 'test_title_1',
                                        'author_by' => 'Author1',
                                        'description_by' => 'lorem ipsum test description text 1',
                                        'title_en' => 'test_title_1',
                                        'author_en' => 'Author1',
                                        'description_en' => 'lorem ipsum test description text 1'
                                        ]);

        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->post('/sites',[
                                                        'url' => 'https://www.testsite2.com',
                                                        'title_ru' => 'test_title_2',
                                                        'author_ru' => 'Author2',
                                                        'description_ru' => 'lorem ipsum  description text 2',
                                                        'title_by' => 'test_title_2',
                                                        'author_by' => 'Author2',
                                                        'description_by' => 'lorem ipsum  description text 2',
                                                        'title_en' => 'test_title_2',
                                                        'author_en' => 'Author2',
                                                        'description_en' => 'lorem ipsum  description text 2'
                                                        ]);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->post('/sites',[
                                                        'url' => 'https://www.testsite3.com',
                                                        'title_ru' => 'test_title_3',
                                                        'author_ru' => 'Author3',
                                                        'description_ru' => 'lorem test description text 3',
                                                        'title_by' => 'test_title_3',
                                                        'author_by' => 'Author3',
                                                        'description_by' => 'lorem test description text 3',
                                                        'title_en' => 'test_title_3',
                                                        'author_en' => 'Author3',
                                                        'description_en' => 'lorem test description text 3',
                                                        ]);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

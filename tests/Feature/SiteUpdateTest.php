<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Site;

class SiteUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->put("/sites/{$id}", [
                                                'url' => 'https://www.testsite-new.com',
                                                'title_ru' => 'new_test_title_1',
                                                'author_ru' => 'Author1',
                                                'description_ru' => 'new ipsum test description text 1',
                                                'title_by' => 'new_test_title_1',
                                                'author_by' => 'Author1',
                                                'description_by' => 'new ipsum test description text 1',
                                                'title_en' => 'new_test_title_1',
                                                'author_en' => 'Author1',
                                                'description_en' => 'new ipsum test description text 1'
                                                ]);

        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($user)->put("/sites/{$id}", [
                                                                'url' => 'https://www.testsite-new.com',
                                                                'title_ru' => 'new_title_2',
                                                                'author_ru' => 'Author2',
                                                                'description_ru' => 'new ipsum description 2',
                                                                'title_by' => 'new_title_2',
                                                                'author_by' => 'Author2',
                                                                'description_by' => 'new ipsum description 2',
                                                                'title_en' => 'new_title_2',
                                                                'author_en' => 'Author2',
                                                                'description_en' => 'new ipsum description 2'
                                                                ]);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($admin)->put("/sites/{$id}", [
                                                                'url' => 'https://www.testsite-new.com',
                                                                'title_ru' => 'new_title_3',
                                                                'author_ru' => 'Author3',
                                                                'description_ru' => 'new ipsum description 3',
                                                                'title_by' => 'new_title_3',
                                                                'author_by' => 'Author3',
                                                                'description_by' => 'new ipsum description 3',
                                                                'title_en' => 'new_title_3',
                                                                'author_en' => 'Author3',
                                                                'description_en' => 'new ipsum description 3'
                                                                ]);

        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

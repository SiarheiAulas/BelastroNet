<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Link;

class LinkUpdateTest extends TestCase
{
   use RefreshDatabase;

   public function test_guest_has_no_access(): void
    {
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->put("/links/{$id}", [
                                            'url' => 'https://www.testlink-new.com',
                                            'description_ru' => 'new ipsum test description text 1',
                                            'title_ru' => 'new_test_title_1',
                                            'description_by' => 'new ipsum test description text 1',
                                            'title_by' => 'new_test_title_1',
                                            'description_en' => 'new ipsum test description text 1',
                                            'title_en' => 'new_test_title_1'
                                            ]);

        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($user)->put("/links/{$id}", [
                                                                'url' => 'https://www.testlink-new.com',
                                                                'description_ru' => 'new ipsum description 2',
                                                                'title_ru' => 'new_title_2',
                                                                'description_by' => 'new ipsum description 2',
                                                                'title_by' => 'new_title_2',
                                                                'description_en' => 'new ipsum description 2',
                                                                'title_en' => 'new_title_2'
                                                                ]);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($admin)->put("/links/{$id}", [
                                                                'url' => 'https://www.testlink-new.com',
                                                                'title_ru' => 'new_title_3',
                                                                'description_ru' => 'new ipsum description 3',
                                                                'title_by' => 'new_title_3',
                                                                'description_by' => 'new ipsum description 3',
                                                                'title_en' => 'new_title_3',
                                                                'description_en' => 'new ipsum description 3'
                                                                ]);

        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

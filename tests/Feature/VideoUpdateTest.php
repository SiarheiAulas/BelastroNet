<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Video;

class VideoUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->put("/videos/{$id}", [
                                                'type' => 'events',
                                                'title_ru' => 'test_title_1',
                                                'description_ru' => 'lorem ipsum test description 1',
                                                'title_by' => 'test_title_1',
                                                'description_by' => 'lorem ipsum test description 1',
                                                'title_en' => 'test_title_1',
                                                'description_en' => 'lorem ipsum test description 1'
                                                ]);

        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_user_has_access_self(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $video = Video::factory()->create(['author_id' => $user->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->put("/videos/{$id}", [
                                                                'type' => 'solar_system',
                                                                'title_ru' => 'new_test_title_2',
                                                                'description_ru' => 'new test description 2',
                                                                'title_by' => 'new_test_title_2',
                                                                'description_by' => 'new test description 2',
                                                                'title_en' => 'new_test_title_2',
                                                                'description_en' => 'new test description 2'
                                                                ]);

        $this->assertTrue(in_array($response->status(), [302 , 200]));
    }

    public function test_user_has_no_access_nonself(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $video = Video::factory()->create(['author_id' => $user2->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->put("/videos/{$id}", [
                                                                'type' => 'sun_and_moon',
                                                                'title_ru' => 'new_test_title_2',
                                                                'description_ru' => 'new test description 2',
                                                                'title_by' => 'new_test_title_2',
                                                                'description_by' => 'new test description 2',
                                                                'title_en' => 'new_test_title_2',
                                                                'description_en' => 'new test description 2'
                                                                ]);

        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->actingAs($admin)->put("/videos/{$id}", [
                                                                'type' => 'misc',
                                                                'title_ru' => 'new_test_title_3',
                                                                'description_ru' => 'new test description 3',
                                                                'title_by' => 'new_test_title_3',
                                                                'description_by' => 'new test description 3',
                                                                'title_en' => 'new_test_title_3',
                                                                'description_en' => 'new test description 3'
                                                                ]);

        $this->assertTrue(in_array($response->status(), [302 , 200]));
    }
}

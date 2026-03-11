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
        $response = $this->put("/videos/{$id}", ['type' => 'events', 'title' => 'test_title_1', 'description' => 'lorem ipsum test description 1']);
        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_user_has_access_self(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $video = Video::factory()->create(['author_id' => $user->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->put("/videos/{$id}", ['type' => 'solar_system', 'title' => 'new_test_title_2', 'description' => 'new test description 2']);
        $this->assertTrue(in_array($response->status(), [302 , 200]));
    }

    public function test_user_has_no_access_nonself(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $video = Video::factory()->create(['author_id' => $user2->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->put("/videos/{$id}", ['type' => 'sun_and_moon', 'title' => 'new_test_title_2', 'description' => 'new test description 2']);
        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->actingAs($admin)->put("/videos/{$id}", ['type' => 'misc', 'title' => 'new_test_title_3', 'description' => 'new test description 3']);
        $this->assertTrue(in_array($response->status(), [302 , 200]));
    }
}

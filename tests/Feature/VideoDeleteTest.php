<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Video;

class VideoDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->delete("/videos/{$id}");
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_access_self(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $video = Video::factory()->create(['author_id' => $user->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->delete("/videos/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }

    public function test_user_has_no_access_nonself(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $video = Video::factory()->create(['author_id' => $user2->id]);
        $id = $video->id;
        $response = $this->actingAs($user)->delete("/videos/{$id}");
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $video = Video::factory()->create();
        $id = $video->id;
        $response = $this->actingAs($admin)->delete("/videos/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Photo;

class PhotoDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->delete("/photos/{$id}");
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_access_self(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $photo = Photo::factory()->create(['author_id' => $user->id]);
        $id = $photo->id;
        $response = $this->actingAs($user)->delete("/photos/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }

    public function test_user_has_no_access_nonself(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $photo = Photo::factory()->create(['author_id' => $user2->id]);
        $id = $photo->id;
        $response = $this->actingAs($user)->delete("/photos/{$id}");
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->actingAs($admin)->delete("/photos/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

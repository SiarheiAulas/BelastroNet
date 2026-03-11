<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Photo;

class PhotoUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->put("/photos/{$id}", ['type' => 'sat', 'title' => 'test_title_1', 'description' => 'lorem ipsum test description 1']);
        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_user_has_access_self(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $photo = Photo::factory()->create(['author_id' => $user->id]);
        $id = $photo->id;
        $response = $this->actingAs($user)->put("/photos/{$id}", ['type' => 'misc', 'title' => 'new_test_title_2', 'description' => 'new test description 2']);
        $this->assertTrue(in_array($response->status(), [302 , 200]));
    }

    public function test_user_has_no_access_nonself(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $user2 = User::factory()->create();
        $photo = Photo::factory()->create(['author_id' => $user2->id]);
        $id = $photo->id;
        $response = $this->actingAs($user)->put("/photos/{$id}", ['type' => 'deepsky', 'title' => 'new_test_title_2', 'description' => 'new test description 2']);
        $this->assertTrue(in_array($response->status(), [302 , 403]));
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $photo = Photo::factory()->create();
        $id = $photo->id;
        $response = $this->actingAs($admin)->put("/photos/{$id}", ['type' => 'landscapes','title' => 'new_test_title_3', 'description' => 'new test description 3']);
        $this->assertTrue(in_array($response->status(), [302 , 200]));
    }
}

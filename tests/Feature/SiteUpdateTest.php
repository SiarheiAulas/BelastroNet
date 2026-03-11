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
        $response = $this->put("/sites/{$id}", ['title' => 'new_test_title_1', 'author' => 'Author1', 'url' => 'https://www.testsite-new.com', 'description' => 'new ipsum test description text 1']);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($user)->put("/sites/{$id}", ['title' => 'new_title_2', 'author' => 'Author2', 'url' => 'https://www.testsite-new.com', 'description' => 'new ipsum description 2']);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($admin)->put("/sites/{$id}", ['title' => 'new_title_3', 'author' => 'Author3', 'url' => 'https://www.testsite-new.com', 'description' => 'new ipsum description 3']);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

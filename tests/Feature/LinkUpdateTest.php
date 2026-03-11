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
        $response = $this->put("/links/{$id}", ['title' => 'new_test_title_1', 'url' => 'https://www.testlink-new.com', 'description' => 'new ipsum test description text 1']);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($user)->put("/links/{$id}", ['title' => 'new_title_2', 'url' => 'https://www.testlink-new.com', 'description' => 'new ipsum description 2']);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($admin)->put("/links/{$id}", ['title' => 'new_title_3', 'url' => 'https://www.testlink-new.com', 'description' => 'new ipsum description 3']);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

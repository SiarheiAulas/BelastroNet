<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Link;

class LinkDeleteTest extends TestCase
{
   use RefreshDatabase;

   public function test_guest_has_no_access(): void
    {
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->delete("/links/{$id}");
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

   public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($user)->delete("/links/{$id}");
        $response->assertStatus(403);
    }

   public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $link = Link::factory()->create();
        $id = $link->id;
        $response = $this->actingAs($admin)->delete("/links/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    } 
}

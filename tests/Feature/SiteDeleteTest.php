<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Site;

class SiteDeleteTest extends TestCase
{
   use RefreshDatabase;

   public function test_guest_has_no_access(): void
    {
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->delete("/sites/{$id}");
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($user)->delete("/sites/{$id}");
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $site = Site::factory()->create();
        $id = $site->id;
        $response = $this->actingAs($admin)->delete("/sites/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

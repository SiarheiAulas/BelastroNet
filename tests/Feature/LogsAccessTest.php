<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogsAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_no_access(): void
    {
        $response = $this->get('/activity-logs');
        $this->assertTrue(in_array($response->status(),[302 , 403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/activity-logs');
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->get('/activity-logs');
        $response->assertStatus(200);
    }
}

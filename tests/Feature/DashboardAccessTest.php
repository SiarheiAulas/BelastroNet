<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_no_access(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }

    public function test_user_has_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertStatus(200);
    }
}

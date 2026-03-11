<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_access(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_has_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }


    public function test_admin_has_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}

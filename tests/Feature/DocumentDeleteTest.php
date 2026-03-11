<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Document;

class DocumentDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->delete("/documents/{$id}");
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($user)->delete("/documents/{$id}");
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($admin)->delete("/documents/{$id}");
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

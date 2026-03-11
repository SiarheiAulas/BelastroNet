<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Document;

class DocumentAccessTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_has_access_index(): void
    {
        $response = $this->get('/documents');

        $response->assertStatus(200);
    }

    public function test_guest_has_access_show(): void
    {
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->get("/documents/{$id}");

        $response->assertStatus(200);
    }

    public function test_guest_has_no_access_create(): void
    {
        $response = $this->get('/documents/create');

        $response->assertStatus(403);
    }

    public function test_guest_has_no_access_edit(): void
    {
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->get("/documents/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_user_has_access_index(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/documents');

        $response->assertStatus(200);
    }

    public function test_user_has_access_show(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($user)->get("/documents/{$id}");

        $response->assertStatus(200);
    }

    public function test_user_has_no_access_create(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response = $this->actingAs($user)->get('/documents/create');

        $response->assertStatus(403);
    }

    public function test_user_has_no_access_edit(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($user)->get("/documents/{$id}/edit");

        $response->assertStatus(403);
    }

    public function test_admin_has_access_index(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/documents');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_show(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($admin)->get("/documents/{$id}");

        $response->assertStatus(200);
    }

    public function test_admin_has_access_create(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get('/documents/create');

        $response->assertStatus(200);
    }

    public function test_admin_has_access_edit(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($admin)->get("/documents/{$id}/edit");

        $response->assertStatus(200);
    }
}

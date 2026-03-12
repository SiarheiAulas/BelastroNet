<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Document;

class DocumentUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->put("/documents/{$id}", [
                                                    'title_ru' => 'new_test_title_1',
                                                    'description_ru' => 'new test description 1',
                                                    'title_by' => 'new_test_title_1',
                                                    'description_by' => 'new test description 1',
                                                    'title_en' => 'new_test_title_1',
                                                    'description_en' => 'new test description 1'
                                                    ]);

        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($user)->put("/documents/{$id}", [
                                                                    'title_ru' => 'new_test_title_2',
                                                                    'description_ru' => 'new test description 2',
                                                                    'title_by' => 'new_test_title_2',
                                                                    'description_by' => 'new test description 2',
                                                                    'title_en' => 'new_test_title_2',
                                                                    'description_en' => 'new test description 2',
                                                                    ]);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $document = Document::factory()->create();
        $id = $document->id;
        $response = $this->actingAs($admin)->put("/documents/{$id}", [
                                                                    'title_ru' => 'new_test_title_3',
                                                                    'description_ru' => 'new test description 3',
                                                                    'title_by' => 'new_test_title_3',
                                                                    'description_by' => 'new test description 3',
                                                                    'title_en' => 'new_test_title_3',
                                                                    'description_en' => 'new test description 3'
                                                                    ]);
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

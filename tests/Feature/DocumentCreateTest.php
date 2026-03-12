<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DocumentCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_has_no_access(): void
    {
        $file = UploadedFile::fake()->create('test1.pdf');
        $response = $this->post('/documents',[
                                            'title_ru' => 'test_title_1',
                                            'description_ru' => 'lorem ipsum test description 1',
                                            'title_by' => 'test_title_1',
                                            'description_by' => 'lorem ipsum test description 1',
                                            'title_en' => 'test_title_1',
                                            'description_en' => 'lorem ipsum test description 1',
                                            'file' => $file
                                            ]);
        $this->assertTrue(in_array($response->status(), [302,403]));
    }

    public function test_user_has_no_access(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $file = UploadedFile::fake()->create('test2.pdf');
        $response = $this->actingAs($user)->post('/documents',[
                                                            'title_ru' => 'test_title_2',
                                                            'description_ru' => 'lorem ipsum test text 2',
                                                            'title_by' => 'test_title_2',
                                                            'description_by' => 'lorem ipsum test text 2',
                                                            'title_en' => 'test_title_2',
                                                            'description_en' => 'lorem ipsum test text 2',
                                                            'file' => $file
                                                            ]);
        $response->assertStatus(403);
    }

    public function test_admin_has_access(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $file = UploadedFile::fake()->create('test3.pdf');
        $response = $this->actingAs($admin)->post('/documents',[
                                                            'title_ru' => 'test_title_3',
                                                            'description_ru' => 'lorem ipsum test description 3',
                                                            'title_by' => 'test_title_3',
                                                            'description_by' => 'lorem ipsum test description 3',
                                                            'title_en' => 'test_title_3',
                                                            'description_en' => 'lorem ipsum test description 3',
                                                            'file' => $file
                                                            ]);
        
        $this->assertTrue(in_array($response->status(), [302,200]));
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Site;

class SiteValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_title_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'url' => 'https://www.testurl1.net',
            //'title_ru' => 'test_title_1',
            'author_ru' => 'Author1',
            'description_ru' => 'test description 1',
            'title_by' => 'test_title_1',
            'author_by' => 'Author1',
            'description_by' => 'test description 1',
            'title_en' => 'test_title_1',
            'author_en' => 'Author1',
            'description_en' => 'test description 1'
            ]);

        $response->assertSessionHasErrors('title_ru');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'url' => 'https://www.testurl_2.com',
            'title_ru' => 123,
            'author_ru' => 'Author2',
            'description_ru' => 'test description 2',
            'title_by' => 'test_title_2',
            'author_by' => 'Author2',
            'description_by' => 'test description 2',
            'title_en' => 'test_title_2',
            'author_en' => 'Author2',
            'description_en' => 'test description 2'
            ]);

        $response->assertSessionHasErrors('title_ru');
    }
    
    public function test_url_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            //'url' => 'https://www.testurl_3.com',
            'title_ru' => 'test_title_3',
            'author_ru' => 'Author3',
            'description_ru' => 'test description 3',
            'title_by' => 'test_title_3',
            'author_by' => 'Author3',
            'description_by' => 'test description 3',
            'title_en' => 'test_title_3',
            'author_en' => 'Author3',
            'description_en' => 'test description 3'
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_url_unique(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $site = Site::create([
            'author_id' => $user->id,
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_4',
            'author_ru' => 'Author4',
            'description_ru' => 'test description 4',
            'title_by' => 'test_title_4',
            'author_by' => 'Author4',
            'description_by' => 'test description 4',
            'title_en' => 'test_title_4',
            'author_en' => 'Author4',
            'description_en' => 'test description 4'
            ]);
        $response = $this->actingAs($user)->post('/sites', [
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_5',
            'author_ru' => 'Author5',
            'description_ru' => 'test description 5',
            'title_by' => 'test_title_5',
            'author_by' => 'Author5',
            'description_by' => 'test description 5',
            'title_en' => 'test_title_5',
            'author_en' => 'Author5',
            'description_en' => 'test description 5'
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_6',
            'author_ru' => 'Author6',
            //'description_ru' => 'test description 6',
            'title_by' => 'test_title_6',
            'author_by' => 'Author6',
            'description_by' => 'test description 6',
            'title_en' => 'test_title_6',
            'author_en' => 'Author6',
            'description_en' => 'test description 6'
            ]);

        $response->assertSessionHasErrors('description_ru');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_7',
            'author_ru' => 'Author7',
            'description_ru' => 123,
            'title_by' => 'test_title_7',
            'author_by' => 'Author7',
            'description_by' => 'test description 7',
            'title_en' => 'test_title_7',
            'author_en' => 'Author7',
            'description_en' => 'test description 7'
            ]);

        $response->assertSessionHasErrors('description_ru');
    }

    public function test_author_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'url' => 'https://www.test_url8.by',
            'title_ru' => 'test_title_8',
            //'author_ru' => 'Author8',
            'description_ru' => 'test description 8',
            'title_by' => 'test_title_8',
            'author_by' => 'Author8',
            'description_by' => 'test description 8',
            'title_en' => 'test_title_8',
            'author_en' => 'Author8',
            'description_en' => 'test description 8',
            ]);

        $response->assertSessionHasErrors('author_ru');
    }

    public function test_author_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'url' => 'https://www.test_url9.by',
            'title_ru' => 'test_title_9',
            'author_ru' => 123,
            'description_ru' => 'test description 9',
            'title_by' => 'test_title_9',
            'author_by' => 'Author9',
            'description_by' => 'test description 9',
            'title_en' => 'test_title_9',
            'author_en' => 'Author9',
            'description_en' => 'test description 9',
            ]);

        $response->assertSessionHasErrors('author_ru');
    }
}

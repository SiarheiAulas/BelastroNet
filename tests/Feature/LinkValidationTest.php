<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Link;

class LinkValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_title_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'url' => 'https://www.testurl1.net',
            //'title_ru' => 'test_title_1',
            'description_ru' => 'test description 1',
            'title_by' => 'test_title_1',
            'description_by' => 'test description 1',
            'title_en' => 'test_title_1',
            'description_en' => 'test description 1'
            ]);

        $response->assertSessionHasErrors('title_ru');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'url' => 'https://www.testurl_2.com',
            'title_ru' => 123,
            'description_ru' => 'test description 2',
            'title_by' => 'test_title_2',
            'description_by' => 'test description 2',
            'title_en' => 'test_title_2',
            'description_en' => 'test description 2'
            ]);

        $response->assertSessionHasErrors('title_ru');
    }
    
    public function test_url_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            //'url' => 'https://www.testurl_3.com',
            'title_ru' => 'test_title_3',
            'description_ru' => 'test description 3',
            'title_by' => 'test_title_3',
            'description_by' => 'test description 3',
            'title_en' => 'test_title_3',
            'description_en' => 'test description 3',
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_url_unique(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $link = Link::create([
            'author_id' => $user->id,
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_4',
            'description_ru' => 'test description 4',
            'title_by' => 'test_title_4',
            'description_by' => 'test description 4',
            'title_en' => 'test_title_4',
            'description_en' => 'test description 4'
            ]);
        $response = $this->actingAs($user)->post('/links', [
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_5',
            'description_ru' => 'test description 5',
            'title_by' => 'test_title_5',
            'description_by' => 'test description 5',
            'title_en' => 'test_title_5',
            'description_en' => 'test description 5'
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_6',
            //'description_ru' => 'test description 6',
            'title_by' => 'test_title_6',
            'description_by' => 'test description 6',
            'title_en' => 'test_title_6',
            'description_en' => 'test description 6'
            ]);

        $response->assertSessionHasErrors('description_ru');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'url' => 'https://www.test_url.by',
            'title_ru' => 'test_title_7',
            'description_ru' => 123,
            'title_by' => 'test_title_7',
            'description_by' => 'test description 7',
            'title_en' => 'test_title_7',
            'description_en' => 'test description 7'
            ]);

        $response->assertSessionHasErrors('description_ru');
    }
}

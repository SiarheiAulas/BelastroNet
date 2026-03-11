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
            //'title' => 'test_title_1',
            'url' => 'https://www.testurl1.net',
            'description' => 'test description 1'
            ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'title' => 123,
            'url' => 'https://www.testurl_2.com',
            'description' => 'test description 2'
            ]);

        $response->assertSessionHasErrors('title');
    }
    
    public function test_url_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'title' => 'test_title_3',
            //'url' => 'https://www.testurl_3.com',
            'description' => 'test description 3'
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_url_unique(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $link = Link::create([
            'author_id' => $user->id,
            'title' => 'test_title_4',
            'url' => 'https://www.test_url.by',
            'description' => 'test description 4'
            ]);
        $response = $this->actingAs($user)->post('/links', [
            'title' => 'test_title_5',
            'url' => 'https://www.test_url.by',
            'description' => 'test description 5'
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'title' => 'test_title_6',
            'url' => 'https://www.test_url.by',
            //'description' => 'test description 6'
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/links', [
            'title' => 'test_title_7',
            'url' => 'https://www.test_url.by',
            'description' => 123
            ]);

        $response->assertSessionHasErrors('description');
    }
}

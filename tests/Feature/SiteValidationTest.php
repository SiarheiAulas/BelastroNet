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
            //'title' => 'test_title_1',
            'author' => 'Author1',
            'url' => 'https://www.testurl1.net',
            'description' => 'test description 1'
            ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'title' => 123,
            'author' => 'Author2',
            'url' => 'https://www.testurl_2.com',
            'description' => 'test description 2'
            ]);

        $response->assertSessionHasErrors('title');
    }
    
    public function test_url_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'title' => 'test_title_3',
            'author' => 'Author3',
            //'url' => 'https://www.testurl_3.com',
            'description' => 'test description 3'
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_url_unique(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $site = Site::create([
            'author_id' => $user->id,
            'title' => 'test_title_4',
            'author' => 'Author4',
            'url' => 'https://www.test_url.by',
            'description' => 'test description 4'
            ]);
        $response = $this->actingAs($user)->post('/sites', [
            'title' => 'test_title_5',
            'author' => 'Author5',
            'url' => 'https://www.test_url.by',
            'description' => 'test description 5'
            ]);

        $response->assertSessionHasErrors('url');
    }

    public function test_description_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'title' => 'test_title_6',
            'author' => 'Author6',
            'url' => 'https://www.test_url.by',
            //'description' => 'test description 6'
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_description_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'title' => 'test_title_7',
            'author' => 'Author7',
            'url' => 'https://www.test_url.by',
            'description' => 123
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_author_required(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'title' => 'test_title_8',
            //'author' => 'Author8',
            'url' => 'https://www.test_url8.by',
            'description' => 'test description 8'
            ]);

        $response->assertSessionHasErrors('author');
    }

    public function test_author_string(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user)->post('/sites', [
            'title' => 'test_title_9',
            'author' => 123,
            'url' => 'https://www.test_url9.by',
            'description' => 'test description 9'
            ]);

        $response->assertSessionHasErrors('author');
    }
}

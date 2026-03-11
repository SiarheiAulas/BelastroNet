<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\RolePermissionSeeder;
use Tests\TestCase;
use App\Models\Article;
use App\Models\News;
use App\Models\Site;
use App\Models\Link;
use App\Models\Document;
use App\Models\Photo;
use App\Models\Video;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SearchTest extends TestCase
{
    use DatabaseMigrations;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        if (!Role::where('name', 'admin')->exists()) {
            $this->seed(RolePermissionSeeder::class);
            }       
    }

    public function test_fulltext_correct_pass(): void
    {
        $user = User::factory()->create();
        
        $article = Article::create(['author_id' => $user->id,'type' => 'workshop', 'title' => 'test_title', 'slug' => 'test_slug_for_article', 'text' => 'test more items, test item 1, new tests for project testing']);
        $news = News::create(['author_id' => $user->id,'title' => 'test_title_for_news', 'slug' => 'test_slug_for_news', 'text' => ' test news. it is a perfect test for test item 1 and 2.']);
        $site = Site::create(['author_id' => $user->id,'title' => 'test item 1 site', 'author' => 'Test Author', 'url' => 'https://www.test.com', 'description' => 'Test site to test some items']);
        $link = Link::create(['author_id' => $user->id,'title' => 'test item 1 external link', 'url' => 'https://test.belastro.net', 'description' => 'Test item 1 site at belastro.net project']);
        $document = Document::create(['author_id' => $user->id,'title' => 'test doc title', 'description' => 'test item 1 photo', 'storage_link' =>'/storage/public/test.pdf']);
        $photo = Photo::create(['author_id' => $user->id,'type' => 'sun_and_moon', 'title' => 'test item 1 photo title', 'description' => 'test photo 1', 'storage_link' =>'/storage/public/test.jpg']);
        $video = Video::create(['author_id' => $user->id,'type' => 'sun_and_moon', 'title' => 'test title for video', 'description' => 'test item 1 vide_0', 'storage_link' =>'/storage/public/test.avi']);

        $response = $this->get('/search?search=test');

        $response->assertStatus(200);
        $this->assertDatabaseHas('articles',['id' => $article->id]);
        $this->assertDatabaseHas('news',['id' => $news->id]);
        $this->assertDatabaseHas('sites',['id' => $site->id]);
        $this->assertDatabaseHas('links',['id' => $link->id]);
        $this->assertDatabaseHas('documents',['id' => $document->id]);
        $this->assertDatabaseHas('photos',['id' => $photo->id]);
        $this->assertDatabaseHas('videos',['id' => $video->id]);
        $response->assertJsonFragment(['id' => $article->id]);
        $response->assertJsonFragment(['id' => $news->id]);
        $response->assertJsonFragment(['id' => $site->id]);
        $response->assertJsonFragment(['id' => $link->id]);
        $response->assertJsonFragment(['id' => $document->id]);
        $response->assertJsonFragment(['id' => $photo->id]);
        $response->assertJsonFragment(['id' => $video->id]);
    }

    public function test_fulltext_incorrect_fail(): void
    {
        $user = User::factory()->create();

        $article = Article::create(['author_id' => $user->id,'type' => 'workshop', 'title' => 'test_title', 'slug' => 'test_slug_for_article', 'text' => 'test more items, test item 1, new tests for project testing']);
        $news = News::create(['author_id' => $user->id,'title' => 'test_title_for_news', 'slug' => 'test_slug_for_news', 'text' => ' test news. it is a perfect test for test item 1 and 2.']);
        $site = Site::create(['author_id' => $user->id,'title' => 'test item 1 site', 'author' => 'Test Author', 'url' => 'https://www.test.com', 'description' => 'Test site to test some items']);
        $link = Link::create(['author_id' => $user->id,'title' => 'test item 1 external link', 'url' => 'https://test.belastro.net', 'description' => 'Test item 1 site at belastro.net project']);
        $document = Document::create(['author_id' => $user->id,'title' => 'test doc title', 'description' => 'test item 1', 'storage_link' =>'/storage/public/test.pdf']);
        $photo = Photo::create(['author_id' => $user->id,'type' => 'sun_and_moon', 'title' => 'test item 1 photo title', 'description' => 'test photo 1', 'storage_link' =>'/storage/public/test.jpg']);
        $video = Video::create(['author_id' => $user->id,'type' => 'sun_and_moon', 'title' => 'test title for video', 'description' => 'test item 1 vide_0', 'storage_link' =>'/storage/public/test.avi']);
        
        $response = $this->get('/search?search=test+fake+string');

        $response->assertStatus(200);
        $response->assertJson([]);
    }

    public function test_search_query_length(): void
    {
        $response = $this->get('/search?search=tst');
        $response->assertJson(['message' => 'Поисковый запрос должен составлять не менее 4 символов']);
    }

    public function test_search_avail_for_guest(): void
    {
        $response =$this->get('/search');
        $response->assertStatus(200);
    }

    public function test_search_avail_for_users(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $response =$this->actingAs($user)->get('/search');
        $response->assertStatus(200);
    }

    public function test_search_avail_for_admin(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response =$this->actingAs($user)->get('/search');
        $response->assertStatus(200);
    }
}

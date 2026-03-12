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
        
        $article = Article::create([
                                'author_id' => $user->id,
                                'type' => 'workshop',
                                'slug' => 'test_slug_for_article',
                                'title_ru' => 'test_title',
                                'text_ru' => 'test more items, test item 1, new tests for project testing',
                                'title_by' => 'test_title',
                                'text_by' => 'test more items, test item 1, new tests for project testing',
                                'title_en' => 'test_title',
                                'text_en' => 'test more items, test item 1, new tests for project testing'
                                ]);

        $news = News::create([
                            'author_id' => $user->id,
                            'slug' => 'test_slug_for_news',
                            'title_ru' => 'test_title_for_news',
                            'text_ru' => ' test news. it is a perfect test for test item 1 and 2.',
                            'title_by' => 'test_title_for_news',
                            'text_by' => ' test news. it is a perfect test for test item 1 and 2.',
                            'title_en' => 'test_title_for_news',
                            'text_en' => ' test news. it is a perfect test for test item 1 and 2.'
                            ]);

        $site = Site::create([
                            'author_id' => $user->id,
                            'url' => 'https://www.test.com',
                            'title_ru' => 'test item 1 site',
                            'author_ru' => 'Test Author',
                            'description_ru' => 'Test site to test some items',
                            'title_by' => 'test item 1 site',
                            'author_by' => 'Test Author',
                            'description_by' => 'Test site to test some items',
                            'title_en' => 'test item 1 site',
                            'author_en' => 'Test Author',
                            'description_en' => 'Test site to test some items'
                            ]);

        $link = Link::create([
                            'author_id' => $user->id,
                            'url' => 'https://test.belastro.net',
                            'title_ru' => 'test item 1 external link',
                            'description_ru' => 'Test item 1 site at belastro.net project',
                            'title_by' => 'test item 1 external link',
                            'description_by' => 'Test item 1 site at belastro.net project',
                            'title_en' => 'test item 1 external link',
                            'description_en' => 'Test item 1 site at belastro.net project',
                            ]);

        $document = Document::create([
                                    'author_id' => $user->id,
                                    'storage_link' =>'/storage/public/test.pdf',
                                    'title_ru' => 'test doc title',
                                    'description_ru' => 'test item 1 photo',
                                    'title_by' => 'test doc title',
                                    'description_by' => 'test item 1 photo',
                                    'title_en' => 'test doc title',
                                    'description_en' => 'test item 1 photo'
                                    ]);

        $photo = Photo::create([
                            'author_id' => $user->id,
                            'type' => 'sun_and_moon',
                            'storage_link' =>'/storage/public/test.jpg',
                            'title_ru' => 'test item 1 photo title',
                            'description_ru' => 'test photo 1',
                            'title_by' => 'test item 1 photo title',
                            'description_by' => 'test photo 1',
                            'title_en' => 'test item 1 photo title',
                            'description_en' => 'test photo 1'
                            ]);

        $video = Video::create([
                                'author_id' => $user->id,
                                'type' => 'sun_and_moon',
                                'storage_link' =>'/storage/public/test.avi',
                                'title_ru' => 'test title for video',
                                'description_ru' => 'test item 1 vide_0',
                                'title_by' => 'test title for video',
                                'description_by' => 'test item 1 vide_0',
                                'title_en' => 'test title for video',
                                'description_en' => 'test item 1 vide_0',
                                ]);

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

        $article = Article::create([
                                    'author_id' => $user->id,
                                    'type' => 'workshop',
                                    'slug' => 'test_slug_for_article',
                                    'title_ru' => 'test_title',
                                    'text_ru' => 'test more items, test item 1, new tests for project testing',
                                    'title_by' => 'test_title',
                                    'text_by' => 'test more items, test item 1, new tests for project testing',
                                    'title_en' => 'test_title',
                                    'text_en' => 'test more items, test item 1, new tests for project testing'
                                    ]);
        $news = News::create([
                            'author_id' => $user->id,
                            'slug' => 'test_slug_for_news',
                            'title_ru' => 'test_title_for_news',
                            'text_ru' => ' test news. it is a perfect test for test item 1 and 2.',
                            'title_by' => 'test_title_for_news',
                            'text_by' => ' test news. it is a perfect test for test item 1 and 2.',
                            'title_en' => 'test_title_for_news',
                            'text_en' => ' test news. it is a perfect test for test item 1 and 2.',
                            ]);

        $site = Site::create(['author_id' => $user->id,
                            'url' => 'https://www.test.com',
                            'title_ru' => 'test item 1 site',
                            'author_ru' => 'Test Author',
                            'description_ru' => 'Test site to test some items',
                            'title_by' => 'test item 1 site',
                            'author_by' => 'Test Author',
                            'description_by' => 'Test site to test some items',
                            'title_en' => 'test item 1 site',
                            'author_en' => 'Test Author',
                            'description_en' => 'Test site to test some items'
                            ]);

        $link = Link::create([
                            'author_id' => $user->id,
                            'url' => 'https://test.belastro.net',
                            'title_ru' => 'test item 1 external link',
                            'description_ru' => 'Test item 1 site at belastro.net project',
                            'title_by' => 'test item 1 external link',
                            'description_by' => 'Test item 1 site at belastro.net project',
                            'title_en' => 'test item 1 external link',
                            'description_en' => 'Test item 1 site at belastro.net project',
                            ]);

        $document = Document::create([
                                    'author_id' => $user->id,
                                    'storage_link' =>'/storage/public/test.pdf',
                                    'title_ru' => 'test doc title',
                                    'description_ru' => 'test item 1',
                                    'title_by' => 'test doc title',
                                    'description_by' => 'test item 1',
                                    'title_en' => 'test doc title',
                                    'description_en' => 'test item 1',
                                    ]);

        $photo = Photo::create([
                            'author_id' => $user->id,
                            'type' => 'sun_and_moon',
                            'storage_link' =>'/storage/public/test.jpg',
                            'title_ru' => 'test item 1 photo title',
                            'description_ru' => 'test photo 1',
                            'title_by' => 'test item 1 photo title',
                            'description_by' => 'test photo 1',
                            'title_en' => 'test item 1 photo title',
                            'description_en' => 'test photo 1',
                            ]);

        $video = Video::create([
                            'author_id' => $user->id,
                            'type' => 'sun_and_moon',
                            'storage_link' =>'/storage/public/test.avi',
                            'title_ru' => 'test title for video',
                            'description_ru' => 'test item 1 vide_0',
                            'title_by' => 'test title for video',
                            'description_by' => 'test item 1 vide_0',
                            'title_en' => 'test title for video',
                            'description_en' => 'test item 1 vide_0',
                            ]);
        
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

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Article;
use App\Models\News;
use App\Models\Document;
use App\Models\Link;
use App\Models\Photo;
use App\Models\Site;
use App\Models\Video;
use App\Policies\ArticlePolicy;
use App\Policies\NewsPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\LinkPolicy;
use App\Policies\PhotoPolicy;
use App\Policies\SitePolicy;
use App\Policies\VideoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
        News::class => NewsPolicy::class,
        Document::class => DocumentPolicy::class,
        Link::class => LinkPolicy::class,
        Photo::class => PhotoPolicy::class,
        Site::class => SitePolicy::class,
        Video::class => VideoPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

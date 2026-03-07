<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\News;
use App\Models\Site;
use App\Models\Link;
use App\Models\Document;
use App\Models\Photo;
use App\Models\Video;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\NewsResource;
use App\Http\Resources\SiteResource;
use App\Http\Resources\LinkResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\PhotoResource;
use App\Http\Resources\VideoResource;

class SearchController extends Controller
{
    public function search(Request $request){

        $search = trim(strtolower($request->search));

        if (strlen($search) < 4){
            return json_encode(['message' => 'Поисковый запрос должен составлять не менее 4 символов']);
        }

        $article = Article::search($search)->get();
        $news = News::search($search)->get();
        $site = Site::search($search)->get();
        $link = Link::search($search)->get();
        $document = Document::search($search)->get();
        $photo = Photo::search($search)->get();
        $video = Video::search($search)->get();

        return json_encode([
            'articles' => ArticleResource::collection($article),
            'news' => NewsResource::collection($news),
            'belastro_sites' => SiteResource::collection($site),
            'external_sites' => LinkResource::collection($link),
            'documents' => DocumentResource::collection($document),
            'photos' => PhotoResource::collection($photo),
            'videos' => VideoResource::collection($video)
            ]);

    }
}

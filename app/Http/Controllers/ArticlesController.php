<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\UploadController;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function __construct(){

        $this->authorizeResource(Article::class, 'article');
    }

    public function index(){
        
        $articles = Article::paginate(20);
        return ArticleResource::collection($articles);
    }

    public function sort_by_type($type){

        $articles = Article::where ('type', $type)->latest()->paginate(20);
        return ArticleResource::collection($articles);
    }

    public function sort_by_author(User $author){

        $articles = Article::where('author_id', $author->id)->latest()->paginate(20);
        return ArticleResource::collection($articles);
    }

    public function show(Article $article){

        return new ArticleResource($article);
    }

    public function create(){

    }

    public function store(ArticleRequest $request){

        $validated = $request->validated();

        $article = new Article;

        $article->type = $request->type;
        $article->author_id = auth()->id();
        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->text = $request->text;

        $article->save();

        return redirect()->back()->with('message', 'Статья создана');
    }

    public function edit(Article $article){

    }

    public function update(ArticleRequest $request, Article $article){

        $validated = $request->validated();
        
        $article->type = $request->type;    
        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->text = $request->text;

        $article->save();

        return redirect()->back()->with('message', 'Статья обновлена');
    }

    public function destroy(Article $article){

        $article->delete();
        return redirect()->back()->with('message', 'Статья удалена');
    }
}

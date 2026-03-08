<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\Request;
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
        
        $articles = Article::all();
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

    }

    public function edit(Article $article){

    }

    public function update(ArticleRequest $request, Article $article){

        $validated = $request->validated();

    }

    public function destroy(Article $article){

        $article->delete();
        return redirect()->back()->with('message', 'Удалено');
    }
}

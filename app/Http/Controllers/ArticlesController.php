<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\UploadController;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function __construct(){

        $this->authorizeResource(Article::class, 'article');
    }

    public function index(){
        
        $article = Article::all();
        return ArticleResource::collection($article);
    }

    public function sort($type){

        $article = Article::where ('type', $type)->paginate(20);

        return ArticleResource::collection($article);
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

    }}

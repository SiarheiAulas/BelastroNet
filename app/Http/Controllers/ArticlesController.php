<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Http\Controllers\UploadController;

class ArticlesController extends Controller
{
    public function __construct(){

        $this->authorizeResource(Article::class, 'article');
    }

    public function index(){
        
        $article = Article::all();
        return json_encode($article);
    }

    public function show(Article $article){

        return json_encode($article);
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

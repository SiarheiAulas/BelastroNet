<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\UploadController;
use App\Http\Resources\NewsResource;

class NewsController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(News::class, 'news');
    }

    public function index(){
       
        $news = News::all();
        return NewsResource::collection($news);
    }

    public function show(News $news){
       
        return new NewsResource($news);
    }

    public function create(){

    }

    public function store(NewsRequest $request){

        $validated = $request->validated();

    }

    public function edit(News $news){

    }

    public function update(NewsRequest $request, News $news){

        $validated = $request->validated();

    }

    public function destroy(News $news){

    }
}

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
       
        $news = News::latest()->paginate(20);
        return NewsResource::collection($news);
    }

    public function show(News $news){
       
        return new NewsResource($news);
    }

    public function create(){

    }

    public function store(NewsRequest $request){

        $validated = $request->validated();
        
        $news = new News;

        $news->author_id = auth()->id();
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->text = $request->text;

        $news->save();

        return redirect()->back()->with('message', 'Новость создана');
    }

    public function edit(News $news){

    }

    public function update(NewsRequest $request, News $news){

        $validated = $request->validated();
        
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->text = $request->text;

        $news->save();

        return redirect()->back()->with('message', 'Новость обновлена');
    }

    public function destroy(News $news){

        $news->delete();
        return redirect()->back()->with('message', 'Новость удалена');
    }
}

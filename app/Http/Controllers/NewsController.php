<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(News::class, 'news');
    }

    public function index(){
       
        $news = News::all();
        return json_encode($news);
    }

    public function show(News $news){
       
        return json_encode($news);
    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function edit(News $news){

    }

    public function update(Request $request, News $news){

    }

    public function destroy(News $news){

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;

class LinksController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Link::class, 'link', ['except' => 'show']);
    }

    public function index(){
       
        $link = Link::paginate(20);
        return LinkResource::collection($link);
    }

    public function create(){

    }

    public function store(LinkRequest $request){

        $validated = $request->validated();

        $link = new Link;

        $link->author_id = auth()->id();
        $link->url = $request->url;
        $link->title_ru = $request->title_ru;
        $link->title_by = $request->title_by;
        $link->title_en = $request->title_en;
        $link->description_ru = $request->description_ru;
        $link->description_by = $request->description_by;
        $link->description_en = $request->description_en;

        $link->save();

        return redirect()->back()->with('message', 'Ссылка добавлена');
    }

    public function edit(Link $link){

    }

    public function update(LinkRequest $request, Link $link){

        $validated = $request->validated();

        $link->url = $request->url;
        $link->title_ru = $request->title_ru;
        $link->title_by = $request->title_by;
        $link->title_en = $request->title_en;
        $link->description_ru = $request->description_ru;
        $link->description_by = $request->description_by;
        $link->description_en = $request->description_en;

        $link->save();

        return redirect()->back()->with('message', 'Ссылка обновлена');
    }

    public function destroy(Link $link){
        
        $link->delete();
        return redirect()->back()->with('message', 'Ссылка удалена');
    }
}

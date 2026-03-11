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
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;

        $link->save();

        return redirect()->back()->with('message', 'Ссылка добавлена');
    }

    public function edit(Link $link){

    }

    public function update(LinkRequest $request, Link $link){

        $validated = $request->validated();

        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;

        $link->save();

        return redirect()->back()->with('message', 'Ссылка обновлена');
    }

    public function destroy(Link $link){
        
        $link->delete();
        return redirect()->back()->with('message', 'Ссылка удалена');
    }
}

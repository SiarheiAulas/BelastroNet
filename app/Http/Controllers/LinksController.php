<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;

class LinksController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Link::class, 'link');
    }

    public function index(){
       
        $link = Link::all();
        return LinkResource::collection($link);
    }

    public function show(Link $link){
       
        return new LinkResource($link);
    }

    public function create(){

    }

    public function store(LinkRequest $request){

        $validated = $request->validated();

    }

    public function edit(Link $link){

    }

    public function update(LinkRequest $request, Link $link){

        $validated = $request->validated();

    }

    public function destroy(Link $link){

    }
}

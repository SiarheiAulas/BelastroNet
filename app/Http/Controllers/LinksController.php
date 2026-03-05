<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinksController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Link::class, 'link');
    }

    public function index(){
       
        $link = Link::all();
        return json_encode($link);
    }

    public function show(Link $link){
       
        return json_encode($link);
    }

    public function create(){

    }

    public function store(Request $request){

        $validated = $request->validated();

    }

    public function edit(Link $link){

    }

    public function update(Request $request, Link $link){

        $validated = $request->validated();

    }

    public function destroy(Link $link){

    }
}

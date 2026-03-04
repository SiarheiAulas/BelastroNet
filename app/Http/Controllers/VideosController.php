<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideosController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Video::class, 'video');
    }

    public function index(){
        
        $video = Video::all();
        return json_encode($video);
    }

    public function show(Video $video){
       
        return json_encode($video);
    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function edit(Video $video){

    }

    public function update(Request $request, Video $video){

    }

    public function destroy(Video $video){

    }
}

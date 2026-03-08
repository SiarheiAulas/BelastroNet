<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\UploadController;
use App\Http\Resources\VideoResource;

class VideosController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Video::class, 'video');
    }

    public function index(){
        
        $video = Video::all();
        return VideoResource::collection($video);
    }

    public function my_videos(){

        if(auth()->id()){
            $author_id = auth()->id();
            $videos = Video::where('author_id', $author_id)->latest()->paginate(20);
            return VideoResource::collection($videos);
        }
    }

    public function sort_by_type($type){

        $videos = Video::where('type', $type)->latest()->paginate(20);
        return VideoResource::collection($videos);
    }

    public function sort_by_author (User $author){

        $videos = Video::where('author_id', $author->id)->latest()->paginate(20);
        return VideoResource::collection($videos);
    }

    public function show(Video $video){
       
        return new VideoResource($video);
    }

    public function create(){

    }

    public function store(VideoRequest $request){

        $validated = $request->validated();

    }

    public function edit(Video $video){

    }

    public function update(VideoRequest $request, Video $video){

        $validated = $request->validated();

    }

    public function destroy(Video $video){
       
        $video->delete();
        return redirect()->back()->with('message', 'Удалено');
    }
}

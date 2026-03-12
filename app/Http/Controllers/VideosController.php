<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use App\Http\Requests\VideoRequest;
use App\Http\Resources\VideoResource;
use App\Http\Controllers\Traits\HasFile;

class VideosController extends Controller
{
    use HasFile;

    public function __construct(){
        
        $this->authorizeResource(Video::class, 'video');
    }

    public function index(){
        
        $video = Video::paginate(20);
        return VideoResource::collection($video);
    }

    public function my_videos(){

        $author_id = auth()->id();
        $videos = Video::where('author_id', $author_id)->latest()->paginate(20);
        return VideoResource::collection($videos);
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

        $video = new Video;

        $video->type = $request->type;
        $video->author_id = auth()->id();
        $video->title_ru = $request->title_ru;
        $video->title_by = $request->title_by;
        $video->title_en = $request->title_en;
        $video->description_ru = $request->description_ru;
        $video->description_by = $request->description_by;
        $video->description_en = $request->description_en;

        $uploaded_video = $request->file('file');
        $video->storage_link = $this->upload_file($uploaded_video);

        $video->save();

        return redirect()->back()->with('message', 'Видео создано');

    }

    public function edit(Video $video){

    }

    public function update(VideoRequest $request, Video $video){

        $validated = $request->validated();

        $video->type = $request->type;
        $video->title_ru = $request->title_ru;
        $video->title_by = $request->title_by;
        $video->title_en = $request->title_en;
        $video->description_ru = $request->description_ru;
        $video->description_by = $request->description_by;
        $video->description_en = $request->description_en;

        if($request->hasFile('file')){
            $uploaded_video = $request->file('file');
            $video->storage_link = $this->upload_file($uploaded_video);
        }

        $video->save();

        return redirect()->back()->with('message', 'Видео обновлено');
    }

    public function destroy(Video $video){
       
        $video->delete();
        return redirect()->back()->with('message', 'Видео удалено');
    }
}

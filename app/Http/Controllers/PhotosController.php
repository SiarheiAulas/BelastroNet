<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use App\Http\Requests\PhotoRequest;
use App\Http\Controllers\UploadController;
use App\Http\Resources\PhotoResource;

class PhotosController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Photo::class, 'photo');
    }

    public function index(){
       
        $photo = Photo::all();
        return PhotoResource::collection($photo);
    }

    public function my_photos(){

        if(auth()->id()){
            $author_id = auth()->id();
            $photos = Photo::where('author_id', $author_id)->latest()->paginate(20);
            return PhotoResource::collection($photos);
        }
    }

    public function sort_by_type($type){

        $photos = Photo::where('type', $type)->latest()->paginate(20);
        return PhotoResource::collection($photos);
    }

    public function sort_by_author (User $author){

        $photos = Photo::where('author_id', $author->id)->latest()->paginate(20);
        return PhotoResource::collection($photos);
    }

    public function show(Photo $photo){
        
        return new PhotoResource($photo);
    }

    public function create(){

    }

    public function store(PhotoRequest $request){

        $validated = $request->validated();

    }

    public function edit(Photo $photo){

    }

    public function update(PhotoRequest $request, Photo $photo){

        $validated = $request->validated();

    }

    public function destroy(Photo $photo){

        $photo->delete();
        return redirect()->back()->with('message', 'Удалено');
    }
}

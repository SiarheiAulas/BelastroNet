<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Http\Controllers\Traits\HasFile;


class PhotosController extends Controller
{
    use HasFile;

    public function __construct(){
        
        $this->authorizeResource(Photo::class, 'photo');
    }

    public function index(){
       
        $photo = Photo::paginate(20);
        return PhotoResource::collection($photo);
    }

    public function my_photos(){

        $author_id = auth()->id();
        $photos = Photo::where('author_id', $author_id)->latest()->paginate(20);
        return PhotoResource::collection($photos);
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

        $photo= new Photo;

        $photo->type = $request->type;
        $photo->author_id = auth()->id();
        $photo->title_ru = $request->title_ru;
        $photo->title_by = $request->title_by;
        $photo->title_en = $request->title_en;
        $photo->description_ru = $request->description_ru;
        $photo->description_by = $request->description_by;
        $photo->description_en = $request->description_en;

        $uploaded_photo = $request->file('file');
        $photo->storage_link = $this->upload_file($uploaded_photo);

        $photo->save();

        return redirect()->back()->with('message', 'Фотография создана');
    }

    public function edit(Photo $photo){

    }

    public function update(PhotoRequest $request, Photo $photo){

        $validated = $request->validated();
        
        $photo->type = $request->type;
        $photo->title_ru = $request->title_ru;
        $photo->title_by = $request->title_by;
        $photo->title_en = $request->title_en;
        $photo->description_ru = $request->description_ru;
        $photo->description_by = $request->description_by;
        $photo->description_en = $request->description_en;

        if($request->hasFile('file')){
            $uploaded_photo = $request->file('file');
            $photo->storage_link = $this->upload_file($uploaded_photo);
        }

        $photo->save();

        return redirect()->back()->with('message', 'Фотография обновлена');
    }

    public function destroy(Photo $photo){

        $photo->delete();
        return redirect()->back()->with('message', 'Фотография удалена');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
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

    }
}

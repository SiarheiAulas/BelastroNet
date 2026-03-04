<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotosController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Photo::class, 'photo');
    }

    public function index(){
       
        $photo = Photo::all();
        return json_encode($photo);
    }

    public function show(Photo $photo){
        
        return json_encode($photo);
    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function edit(Photo $photo){

    }

    public function update(Request $request, Photo $photo){

    }

    public function destroy(Photo $photo){

    }
}

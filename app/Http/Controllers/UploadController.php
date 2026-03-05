<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Photo;
use App\Models\Video;

class UploadController extends Controller
{
    public function upload(Request $request){
        
        if ($request->file('file')){
           
            $file = $request->file('file');
            $fileExt = strtolower($file->getClientOriginalExtension());
            $fileName = $file->getClientOriginalName();
            
            $date = now()->format('d-m-Y');
            
            $img_ext_options = ['jpg','jpeg','png','gif','tiff','raw','bmp','svg','webp','heic','fits'];
            $video_ext_options = ['mp4','mov','avi','mkv','webm','mpeg'];
            
            if(in_array($fileExt, $img_ext_options)){
                    $type = 'img';
            } elseif (in_array($fileExt, $video_ext_options)){
                    $type = 'movie';
            } else {
                    $type = 'doc';
            }
            
            $path = $file->storeAs("$type/$date", $fileName, 'public');
            $url = asset('storage/' . $path);
            
            return json_encode($url);
        }
    }
}
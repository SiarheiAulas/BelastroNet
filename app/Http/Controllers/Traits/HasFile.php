<?php

namespace App\Http\Controllers\Traits\HasFile;

trait HasFile {

	public function upload_file($file){
                  
            $fileExt = strtolower($file->getClientOriginalExtension());
            $fileName = $file->getClientOriginalName();
            
            $date = now()->format('d-m-Y');
            
            $img_options = ['jpg','jpeg','png','gif','tiff','raw','bmp','svg','webp','heic','fits'];
            $video_options = ['mp4','mov','avi','mkv','webm','mpeg'];
            
            if(in_array($fileExt, $img_options)){
                    $type = 'img';
            } elseif (in_array($fileExt, $video_options)){
                    $type = 'movie';
            } else {
                    $type = 'doc';
            }
            
            $path = $file->storeAs("$type/$date", $fileName, 'public');
            $url = asset('storage/' . $path);
          
            return $url;
}
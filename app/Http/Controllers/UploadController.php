<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Photo;
use App\Models\Video;
use App\Http\Controllers\Traits\HasFile;

class UploadController extends Controller
{
    use HasFile;

    public function upload(Request $request){
        
        if ($request->hasFile('file')){
           
            $file = $request->file('file');
            return $this->upload_file($file);
        }
    }
}
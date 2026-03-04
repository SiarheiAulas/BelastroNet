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
            $fileExt = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $date = now()->format('d-m-Y');
            switch ($fileExt) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'tiff':
                case 'raw':
                case 'bmp':
                case 'svg':
                case 'webp':
                case 'heic':
                case 'fits':
                    $type = 'img';
                    break;
                case 'mp4':
                case 'mov':
                case 'avi':
                case 'mkv':
                case 'webm':
                case 'mpeg':
                    $type = 'movie';
                    break;
                default:
                    $type = 'doc';
                    break;
            }
            $path = $file->storeAs("$type/$date", $fileName, 'public');
            $url = asset('storage/' . $path);
            return json_encode($url);
        }
    }
}

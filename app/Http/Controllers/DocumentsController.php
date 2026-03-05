<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\Request;
use App\Models\Document;
use App\Http\Requests\DocumentRequest;
use App\Http\Controllers\UploadController;
use App\Http\Resources\DocumentResource;

class DocumentsController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Document::class, 'document');
    }

    public function index(){
      
        $document = Document::all();
        return DocumentResource::collection($document);
    }

    public function show(Document $document){
        
        return new DocumentResource($document);
    }

    public function create(){

    }

    public function store(DocumentRequest $request){

        $validated = $request->validated();

    }

    public function edit(Document $document){

    }

    public function update(DocumentRequest $request, Document $document){

        $validated = $request->validated();

    }

    public function destroy(Document $document){

    }
}

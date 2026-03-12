<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Http\Requests\DocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Http\Controllers\Traits\HasFile;

class DocumentsController extends Controller
{
    use HasFile;

    public function __construct(){
        
        $this->authorizeResource(Document::class, 'document');
    }

    public function index(){
      
        $document = Document::paginate(20);
        return DocumentResource::collection($document);
    }

    public function show(Document $document){
        
        return new DocumentResource($document);
    }

    public function create(){

    }

    public function store(DocumentRequest $request){

        $validated = $request->validated();
        
        $document = new Document;

        $document->author_id = auth()->id();
        $document->title_ru = $request->title_ru;
        $document->title_by = $request->title_by;
        $document->title_en = $request->title_en;
        $document->description_ru = $request->description_ru;
        $document->description_by = $request->description_by;
        $document->description_en = $request->description_en;

        $file = $request->file('file');
        $document->storage_link = $this->upload_file($file);

        $document->save();

        return redirect()->back()->with('message', 'Документ добавлен');

    }

    public function edit(Document $document){

    }

    public function update(DocumentRequest $request, Document $document){

        $validated = $request->validated();

        if($request->hasFile('file')){
            $file = $request->file('file');
            $document->storage_link = $this->upload_file($file);
        }

        $document->title_ru = $request->title_ru;
        $document->title_by = $request->title_by;
        $document->title_en = $request->title_en;
        $document->description_ru = $request->description_ru;
        $document->description_by = $request->description_by;
        $document->description_en = $request->description_en;

        $document->save();

        return redirect()->back()->with('message', 'Документ обновлен');
    }

    public function destroy(Document $document){

        $document->delete();
        return redirect()->back()->with('message', 'Документ удален');
    }
}

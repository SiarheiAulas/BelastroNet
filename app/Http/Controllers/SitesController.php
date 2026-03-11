<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Http\Requests\SiteRequest;
use App\Http\Resources\SiteResource;

class SitesController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Site::class, 'site', ['except' => 'show']);
    }

    public function index(){
      
        $site = Site::paginate(20);
        return SiteResource::collection($site);
    }

    
    public function create(){

    }

    public function store(SiteRequest $request){

        $validated = $request->validated();

        $site = new Site;

        $site->author_id = auth()->id();
        $site->author = $request->author;
        $site->title = $request->title;
        $site->url = $request->url;
        $site->description = $request->description;

        $site->save();

        return redirect()->back()->with('message', 'Сайт добавлен');

    }

    public function edit(Site $site){

    }

    public function update(SiteRequest $request, Site $site){

        $validated = $request->validated();
        
        $site->author = $request->author;
        $site->title = $request->title;
        $site->url = $request->url;
        $site->description = $request->description;

        $site->save();

        return redirect()->back()->with('message', 'Сайт обновлен');

    }

    public function destroy(Site $site){

        $site->delete();
        return redirect()->back()->with('message', 'Сайт удален');
    }
}

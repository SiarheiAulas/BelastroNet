<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Http\Requests\SiteRequest;
use App\Http\Resources\SiteResource;

class SitesController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Site::class, 'site');
    }

    public function index(){
      
        $site = Site::all();
        return SiteResource::collection($site);
    }

    public function show(Site $site){
      
        return new SiteResource($site);
    }

    public function create(){

    }

    public function store(SiteRequest $request){

        $validated = $request->validated();

    }

    public function edit(Site $site){

    }

    public function update(SiteRequest $request, Site $site){

        $validated = $request->validated();

    }

    public function destroy(Site $site){

    }
}

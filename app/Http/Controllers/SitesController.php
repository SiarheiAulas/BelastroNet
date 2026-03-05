<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class SitesController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Site::class, 'site');
    }

    public function index(){
      
        $site = Site::all();
        return json_encode($site);
    }

    public function show(Site $site){
      
        return json_encode($site);
    }

    public function create(){

    }

    public function store(Request $request){

        $validated = $request->validated();

    }

    public function edit(Site $site){

    }

    public function update(Request $request, Site $site){

        $validated = $request->validated();

    }

    public function destroy(Site $site){

    }
}

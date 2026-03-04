<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index(){
        $test = ['route'=>'articles', 'content'=>'Articles List'];
        $test = json_encode($test);
        return $test;
    }

    public function show(Request $request){

    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function edite(Request $request){

    }

    public function update(Request $request){

    }

    public function delete(Request $request){

    }}

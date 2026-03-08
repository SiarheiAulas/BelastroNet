<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserIndexShowController extends Controller
{
    public function __construct(){
    
        $this->authorizeResource(User::class, 'user');
    }

    public function index(){

        $users = User::paginate(20);
        return UserResource::collection($users);
    }

    public function show(User $user){

        return new UserResource($user);
    }
}

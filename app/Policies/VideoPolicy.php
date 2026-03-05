<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;

class VideoPolicy
{
    public function viewAny(? User $user){

        return true;
    }

    public function view(? User $user, Video $video){

        return true;
    }

    public function create(User $user){

        return true;
    }


    public function update(User $user, Video $video){

        return $user->hasRole('admin')||$video->author_id === $user->id;
    }

    public function delete(User $user, Video $video){

        return $user->hasRole('admin')||$video->author_id === $user->id;
    }
}

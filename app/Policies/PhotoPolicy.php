<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Photo;

class PhotoPolicy
{
    public function viewAny(? User $user){

        return true;
    }

    public function view(? User $user, Photo $photo){

        return true;
    }

    public function create(User $user){

        return true;
    }


    public function update(User $user, Photo $photo){

        return $user->hasRole('admin')||$photo->author_id === $user->id;
    }

    public function delete(User $user, Photo $photo){

        return $user->hasRole('admin')||$photo->author_id === $user->id;
    }
}

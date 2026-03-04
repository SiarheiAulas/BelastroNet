<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Link;

class LinkPolicy
{
    public function viewAny(? User $user){

        return true;
    }

    public function view(? User $user, Link $link){

        return true;
    }

    public function create(User $user){

        return $user->hasRole('admin');
    }


    public function update(User $user, Link $link){

        return $user->hasRole('admin');
    }

    public function delete(User $user, Link $link){

        return $user->hasRole('admin');
    }
}

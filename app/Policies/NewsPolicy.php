<?php

namespace App\Policies;

use App\Models\User;
use App\Models\News;

class NewsPolicy
{
    public function viewAny(? User $user){

        return true;
    }

    public function view(? User $user, News $news){

        return true;
    }

    public function create(User $user){

        return $user->hasRole('admin');
    }


    public function update(User $user, News $news){

        return $user->hasRole('admin');
    }

    public function delete(User $user, News $news){

        return $user->hasRole('admin');
    }
}

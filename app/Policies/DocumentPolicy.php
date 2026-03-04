<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Document;


class DocumentPolicy
{
    public function viewAny(? User $user){

        return true;
    }

    public function view(? User $user, Document $document){

        return true;
    }

    public function create(User $user){

        return $user->hasRole('admin');
    }


    public function update(User $user, Document $document){

        return $user->hasRole('admin');
    }

    public function delete(User $user, Document $document){

        return $user->hasRole('admin');
    }
}

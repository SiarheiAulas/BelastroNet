<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return true;
    }

    public function create(User $user){

        return false;
    }


    public function update(User $user, User $model){

        return false;
    }

    public function delete(User $user, User $model){

        return $user->hasRole('admin');
    }
}

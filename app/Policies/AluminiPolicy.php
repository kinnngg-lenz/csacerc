<?php

namespace App\Policies;

use App\Alumini;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AluminiPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Alumini $alumini)
    {
        if($user->isAdmin())
            return true;

        return $user->id === $alumini->user_id;
    }
}

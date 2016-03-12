<?php

namespace App\Policies;

use App\Shout;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoutPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function delete(User $user, Shout $shout)
    {
        if($user->isSuperAdmin())
        {
            return true;
        }
        return $user->id === $shout->user_id;
    }
}

<?php

namespace App\Policies;

use App\Quote;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Quote $quote)
    {
        if($user->isSuperAdmin())
            return true;

        if(!$user->isAdmin())
            return false;

        return $quote->user_id == $user->id;
    }
}

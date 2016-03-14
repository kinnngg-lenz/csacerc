<?php

namespace App\Policies;

use App\CodeWarAnswer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CodeWarAnswerPolicy
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

    public function edit(User $user, CodeWarAnswer $answer)
    {
        if($user->isSuperAdmin())
            return true;

        /**
         * If War Closed
         */
        if(!$answer->question->isOpen())
        {
            return false;
        }

        return $answer->user_id == $user->id;
    }
}

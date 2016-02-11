<?php

namespace App\Policies;

use App\CodeWarQuestion;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CodeWarQuestionPolicy
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

    public function edit(User $user, CodeWarQuestion $question)
    {
        if(!$user->isAdmin())
            return false;

        return $question->user_id == $user->id;
    }
}

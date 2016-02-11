<?php

namespace App\Policies;

use App\Question;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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

    /**
     * @param User $user
     * @param Question $question
     * @return bool
     */
    public function answer(User $user,Question $question)
    {
        /**
         * If already answered then return false.
         */
        if(!is_null($question->answer))
            return false;

        /**
         * If question is asked globally then any admin can Answer
         */
        if(is_null($question->for_user_id))
            return $user->isAdmin() ? true : false;

        /**
         * If User is Answerer
         */
        return $user->id == $question->for_user_id;
    }
}

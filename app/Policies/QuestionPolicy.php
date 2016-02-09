<?php

namespace App\Policies;

use App\Question;
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

    public function answer(User $user, Question $question)
    {
        return $user->id == $question->for_user_id;
    }
}

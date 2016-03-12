<?php

namespace App\Policies;

use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
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

    public function edit(User $user, Message $message)
    {
        return $user->id === $message->sender_id;
    }

    public function delete(User $user, Message $message)
    {
        /**
         * For Admin View
         * It disable delete btn in admin view when viewed with trashed
         */
        if(!is_null($message->deleted_at))
        {
            return false;
        }

        if($user->isSuperAdmin())
        {
            return true;
        }
        return $user->id === $message->sender_id;
    }
}

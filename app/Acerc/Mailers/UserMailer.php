<?php
/**
 * Created by PhpStorm.
 * User: Zishan
 * Date: 09-Feb-16
 * Time: 6:56 PM
 */

namespace App\Acerc\Mailers;

use App\User;

class UserMailer extends Mailer
{
    public function welcome(User $user)
    {
        $view = 'auth.emails.welcome';
        $data = [];
        $subject = "Welcome to Computer Science Dept of ACERC";

        return $this->sendTo($user, $subject, $view, $data);
    }
}
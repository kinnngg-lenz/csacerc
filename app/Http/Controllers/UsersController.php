<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'showProfile']);
    }

    /**
     * Show Users Profile
     *
     * @param $username
     */
    public function showProfile($username)
    {
        $user  = User::whereUsername($username)->firstOrFail();
        return view('users.profile')->withUser($user);
    }

    /**
     * Edit Users Profile
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editProfile($username)
    {
        $user = User::whereUsername($username)->firstOrFail();
        if(Auth::user() != $user)
        {
            return redirect('/');
        }
        return view('users.edit')->withUser($user);
    }

    public function updateProfile($username, Request $request)
    {
        $user = User::whereUsername($username)->firstOrFail();
        if(Auth::user() != $user)
        {
            return redirect('/');
        }

        $this->validate($request, [
            'dob' => 'required',
            'name' => 'required',
            'about' => 'required',
        ]);

        $user->fill($request->only('dob', 'name', 'about'))->save();

        return back()->withNotification('Profile has been updated');

    }
}

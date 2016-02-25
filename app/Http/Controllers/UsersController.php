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
        $this->middleware('auth', ['except' => ['showProfile', 'search']]);
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
            'dob' => 'required|date|before:2016-01-01',
            'name' => 'required',
            'about' => 'required',
            'college_id' => 'required|exists:colleges,id',
            'department_id' => 'required|exists:departments,id'
        ]);

        $user->fill($request->only('dob', 'name', 'about', 'college_id', 'department_id'))->save();

        return back()->withNotification('Profile has been updated');

    }


    /**
     * For searching User for Ajax and API calls
     *
     * Here Auth will not be considered as it is outside of web middleware group
     *
     * @param $query
     * @return mixed
     */
    public function search($query)
    {
        return (User::where('username','like','%'.$query.'%')->orWhere('name','like','%'.$query.'%')->orWhere('email','like','%'.$query.'%')->get(['id','name','username']));
    }
}

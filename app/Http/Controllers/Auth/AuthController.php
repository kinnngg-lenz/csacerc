<?php

namespace App\Http\Controllers\Auth;

use App\Acerc\Mailers\UserMailer;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Newsletter;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * @var UserMailer
     */
    protected $mailer;

    /**
     * Create a new authentication controller instance.
     * @param UserMailer $mailer
     */
    public function __construct(UserMailer $mailer)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->mailer = $mailer;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'username' => 'required|min:4|max:255|Regex:/([a-zA-Z0-9_])+$/i|unique:users',
            'gender' => 'required|in:Male,Female,Others',
            'type' => 'required|in:0,1',
            'college_id' => 'required|exists:colleges,id',
            'department_id' => 'required|exists:departments,id'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user  =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'gender' => $data['gender'],
            'type' => $data['type'],
            'college_id' => $data['college_id'],
            'department_id' => $data['department_id'],
        ]);

        /**
         * EMAIL User a Welcome Email
         * @TODO: Add this to a Queue and extract to a Event Listener
         */
        $this->mailer->welcome($user);

        \Session::flash('user.has.registered',true);

        /**
         *Subscribe this user to Weekly Newsletter
         *@TODO: Enable this in production
         */
        //Newsletter::subscribe($user->email);

        return $user;
    }

    /**
     * Login System
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

            //Put in Session that User is Authenticated
            \Session::flash('user.has.loggedin',true);

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
}

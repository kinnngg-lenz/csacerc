<?php

namespace App\Http\Controllers\Auth;

use App\Acerc\Mailers\UserMailer;
use App\Photo;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Newsletter;
use Image;

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'username' => 'required|min:4|max:255|alpha_dash|unique:users',
            'gender' => 'required|in:Male,Female,Others',
            'type' => 'required|in:0,1',
            'college_id' => 'required|exists:colleges,id',
            'department_id' => 'required|exists:departments,id',
            'photo' => 'image|max:500',
            'batch' => 'required_if:type,0',

            'speech' => 'min:10',
            'profession' => 'required_with:alumini',
            'organisation_id' => 'exists:organisations,id',
            'facebook' => '',
        ],
            [
                'required'    => 'Please specify your :attribute',
                'name.required' => 'Please specify your Full name',
                'max'    => 'The :attribute must note be greater than :size.',
                'username.alpha_dash' => 'The :attribute must only contain Alphabets,numbers,dashes or underscore',
                'in'      => 'The :attribute must be one of the following types: :values',
                'photo.image' => "Profile picture must be image type",
                'photo.max' => "Profile picture must not be greater than 500kb in size",
                'batch.required_if' => "Please select your batch",
                'type.in' => "You must select your account type",
                'type.required' => "Please select account type",
                'password.required' => "Please specify a strong password",
                'college_id.required' => "You must select your belonging college",
                'department_id.required' => "You must select your belonging department",
                'exists' => "Invalid :attribute selected",
                'profession.required_with' => "Please specify your profession",

            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        if (isset($data['photo']) && $data['photo']->isValid()) {
                $photoName = md5(Carbon::now()) . "." . $data['photo']->getClientOriginalExtension();

                $image = Image::make($data['photo']);
                $image->fit(300)->save(public_path('images/') . $photoName);

                $photo = Photo::create([
                    'url' => $photoName
                ]);

                $photoId = $photo->id;
        } else {
            $photoId = null;
        }

        /**
         * Allow Insertion of Batch only if Submitter is Student
         */
        $batch = $data['type'] == 0 ? $data['batch'] : null;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'gender' => $data['gender'],
            'type' => $data['type'],
            'college_id' => $data['college_id'],
            'department_id' => $data['department_id'],
            'photo_id' => $photoId,
            'batch' => $batch,
            'register_time_ip' => \Request::getClientIp()
        ]);

        /**
         * EMAIL User a Welcome Email
         * @TODO: Add this to a Queue and extract to a Event Listener
         */
        /*$this->mailer->welcome($user);*/

        /**
         * Create Alumini
         */
        if (isset($data['alumini'])) {

            $slug = slug_for_url($data['name'].' of '.$data['batch'].'-'.$data['profession']);

            $speech = empty($data['speech']) ? null : $data['speech'];
            $facebook = empty($data['facebook']) ? null : $data['facebook'];
            $organisation_id = empty($data['organisation_id']) ? null : $data['organisation_id'];

            $user->aluminis()->create([
                'speech' => $speech,
                'speaker' => $data['name'],
                'batch' => $batch,
                'department_id' => $data['department_id'],
                'profession' => $data['profession'],
                'organisation_id' => $organisation_id,
                'photo_id' => $photoId,
                'email' => $data['email'],
                'facebook' => $facebook,
                'slug' => $slug,
            ]);

        }

        \Session::flash('user.has.registered', true);

        /**
         *Subscribe this user to Weekly Newsletter
         * @TODO: Enable this in production
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
            \Session::flash('user.has.loggedin', true);

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        \Session::flash('user.has.loggedout', Auth::user()->email);
        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/login');
    }
}

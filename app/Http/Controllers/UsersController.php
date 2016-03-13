<?php

namespace App\Http\Controllers;

use App\Alumini;
use App\Photo;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showProfile', 'search', 'searchForNav']]);
    }

    /**
     * Show Users Profile
     *
     * @param $username
     */
    public function showProfile($username)
    {
        $user = User::whereUsername($username)->firstOrFail();
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
        if (Auth::user() != $user) {
            return redirect('/');
        }
        return view('users.edit')->withUser($user);
    }

    public function updateProfile($username, Request $request)
    {
        $user = User::whereUsername($username)->firstOrFail();

        if (Auth::user() != $user) {
            return redirect('/');
        }

        $this->validate($request, [
            'dob' => 'required|date|before:2016-01-01',
            'name' => 'required',
            'about' => 'required',
            'college_id' => 'required|exists:colleges,id',
            'department_id' => 'required|exists:departments,id',
            'photo' => 'image|max:500',
        ], [
            'dob.required' => 'Please specify your Date of Birth.',
            'dob.date' => 'Invalid Date of Birth format',
            'dob.before' => 'You are not enough old :)',
            'name.required' => 'Please specify your Full name',
            'about.required' => 'Please tell us something about yourself',
            'college_id.required' => "You must select your belonging college",
            'department_id.required' => "You must select your belonging department",
            'exists' => "Invalid :attribute selected",
            'photo.image' => "Profile picture must be image type",
            'photo.max' => "Profile picture must not be greater than 500kb in size",
        ]);

        /**
         * If Request has Photo Uploaded Then
         * 1> Delete prev Image
         * 2> Store Photo in storage and link in DB
         * 3> Pass new PhotoId
         */
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Create name for new Image
            $photoName = md5(Carbon::now()) . "." . $request->file('photo')->getClientOriginalExtension();

            // Move image to storage
            $image = Image::make($request->file('photo'));
            $image->fit(300)->save(public_path('images/') . $photoName);
            $photo = Photo::create([
                'url' => $photoName
            ]);

            /*
             * Delete previous Profile pic if any
             * Delete only if this Photo is not referenced by any Alumini profile.
             */
            if ($prevPic = $request->user()->photo) {
                // If any alumini references then ignore deletion else delete
                if (Alumini::where('photo_id', $prevPic->id)->first() == null) {
                    $file = public_path('images/') . $prevPic->url;
                    if (File::exists($file)) {
                        // Delete from Storage
                        File::delete($file);
                        // Delete link from DB
                        $user->photo_id = null;
                        $user->save();
                        $prevPic->delete();
                    }
                }
            }
            $photoId = $photo->id;
        } /**
         * If No Upload Then
         * 1> Check if already has a profile Pic
         *  Yes? : Pass old profile pic Id.
         *  No?  : Pass null as Profile pic Id
         */
        else {
            if ($prevPic = $request->user()->photo) {
                $photoId = $prevPic->id;
            } else {
                $photoId = null;
            }
        }

        $user->update([
            'dob' => $request->dob,
            'name' => $request->name,
            'about' => $request->about,
            'college_id' => $request->college_id,
            'department_id' => $request->department_id,
            'photo_id' => $photoId
        ]);

        return back()->withNotification('Profile has been updated')->withType('success');

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
        return (User::where('username', 'like', '%' . $query . '%')->orWhere('name', 'like', '%' . $query . '%')->orWhere('email', 'like', '%' . $query . '%')->get(['id', 'name', 'username']));
    }

    public function searchForNav(Request $request)
    {
        $query = $request->get('q');
        $users = User::where('username', 'like', '%' . $query . '%')->orWhere('name', 'like', '%' . $query . '%')->orWhere('email', 'like', '%' . $query . '%')->paginate(10);
        $aluminis = Alumini::where('speaker', 'like', '%' . $query . '%')->orWhere('batch', 'like', '%' . $query . '%')->orWhere('profession', 'like', '%' . $query . '%')->orWhere('email', 'like', '%' . $query . "%")->paginate(10);
        return view('users.search')->withUsers($users)->withAluminis($aluminis);
    }

    /**
     * @param Request $request
     * @param $username
     * @return mixed
     */
    public function toggleBanUser(Request $request, $username)
    {
        if ($request->username != $username) {
            return back()->withNotification("Aw! Please don't try to mess up the code ;)")->withType('danger');
        }

        $user = User::whereUsername($request->username)->first();

        if (is_null($user)) {
            return back()->withNotification("Sorry! User not found")->withType('warning');
        }

        if ($request->user()->role <= $user->role) {
            return back()->withNotification("Sorry! You don't have rights to ban this user")->withType('danger');
        }

        if ($user->banned == 1) {
            $user->banned = 0;
            $user->save();
            return back()->withNotification("Success! You have unbanned this user")->withType('success');
        } elseif ($user->banned == 0) {
            $user->banned = 1;
            $user->save();
            return back()->withNotification("Success! You have banned this user")->withType('success');
        }

        return back()->withNotification("Error! something not well")->withType('danger');
    }

    public function verifyAccount(User $user,Request $request)
    {
        if(!$request->user()->isSuperAdmin())
        {
            return back()->withNotification("Sorry! You are not authorized")->withType("danger");
        }

        $user->approved = 1;
        $user->save();

        return back()->withNotification("Success! User is now verified")->withType("success");
    }

    /**
     * @param User $id
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function destroy(User $id, Request $request)
    {
        if(!$request->user()->isSuperAdmin())
        {
            return back()->withNotification("Sorry! You are not authorized")->withType("danger");
        }

        $user = $id;
        $user->aluminis()->delete();
        $user->messages()->delete();
        $user->allMessages()->delete();
        $Pic = $user->photo;
        $user->delete();
        /*
             * Delete Profile pic if any
             * Delete only if this Photo is not referenced by any Alumini profile.
             */
        if ($Pic) {
            // If any alumini references then ignore deletion else delete
            $file = public_path('images/') . $Pic->url;
            if (File::exists($file)) {
                // Delete from Storage
                File::delete($file);
                // Delete link from DB
                $Pic->delete();
            }
        }
        return redirect('/')->withNotification("Success! User deleted");
    }
}
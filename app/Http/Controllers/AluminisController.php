<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AluminisRequest;
use App\Alumini;

class AluminisController extends Controller
{
    protected $alumini;

    public function __construct(Alumini $alumini)
    {
        $this->alumini = $alumini;
        $this->middleware('auth',['except' => ['index', 'show']]);
        $this->middleware('admin', ['except' => ['index', 'show', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->batch)) {
            $batch = $request->batch;
            $aluminis = $this->alumini->whereBatch($batch)->latest()->paginate();
        }
        else
        {
            $aluminis = $this->alumini->orderBy('photo_id')->latest()->paginate();
        }

        return view('aluminis.index')->withAluminis($aluminis);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aluminis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AluminisRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AluminisRequest $request)
    {

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $photoName = md5(Carbon::now()).".".$request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('images'), $photoName);

                $photo = Photo::create([
                    'url' => $photoName
                ]);

                $photoId = $photo->id;
            }
            else {
                return back()->withNotification('Error! Photo is invalid')->withType('danger');
            }
        }
        else
        {
            $photoId = null;
        }

                $slug = slug_for_url($request->speaker.' of '.$request->batch.'-'.$request->profession);

                $speech = empty($request->speech) ? null : $request->speech;
                $facebook = empty($request->facebook) ? null : $request->facebook;
                $organisation_id = empty($request->organisation_id) ? null : $request->organisation_id;

                $request->user()->aluminis()->create([
                    'speech' => $speech,
                    'speaker' => $request->speaker,
                    'batch' => $request->batch,
                    'department_id' => $request->department_id,
                    'profession' => $request->profession,
                    'organisation_id' => $organisation_id,
                    'photo_id' => $photoId,
                    'email' => $request->email,
                    'facebook' => $facebook,
                    'slug' => $slug,
                ]);
                return back()->withNotification('A New Alumini has been added successfully!')->withType('success');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $alumini = Alumini::whereSlug($slug)->firstorFail();
        return view('aluminis.show')->withAlumini($alumini);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumini $id)
    {
        if(Auth::user()->can('edit',$id)) {
            return view('aluminis.edit')->withAlumini($id);
        }
        else {
            return redirect('/')->withNotification('You are not authorized')->withType('danger');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Alumini $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Alumini $id)
    {
        if($request->user()->can('edit',$id)) {
            $this->validate($request, [
                'speaker' => 'required|min:5',
                'speech' => '',
                'profession' => 'required',
                'batch' => 'required|min:2',
                'organisation_id' => 'exists:organisations,id',
                'email' => 'required|email',
                'facebook' => '',
                'department_id' => 'required|exists:departments,id',
                'user_id' => 'required|exists:users,id',
                'photo' => 'image|max:500'
            ]);

            /**
             * If Request has Photo Uploaded Then
             * 1> Delete prev Image
             * 2> Store Photo in storage and link in DB
             * 3> Pass new PhotoId
             */
            if ($request->hasFile('photo') && $request->file('photo')->isValid())
            {
                // Create name for new Image
                $photoName = md5(Carbon::now()).".".$request->file('photo')->getClientOriginalExtension();

                // Move image to storage
                $request->file('photo')->move(public_path('images'), $photoName);

                $photo = Photo::create([
                    'url' => $photoName
                ]);

                /*
                 * Delete previous pic if any
                 * Delete only if this Photo is not referenced by any User profile.
                 */
                if($prevPic = $id->photo)
                {
                    // If any User references then ignore deletion else delete
                    if(User::where('photo_id',$prevPic->id)->first() == null)
                    {
                        $file = public_path('images/').$prevPic->url;
                        if(File::exists($file))
                        {
                            // Delete from Storage
                            File::delete($file);
                            // Delete link from DB
                            $id->photo_id = null;
                            $id->save();
                            $prevPic->delete();
                        }
                    }
                }
                $photoId = $photo->id;
            }
            /**
             * If No Upload Then
             * 1> Check if already has a profile Pic
             *  Yes? : Pass old profile pic Id.
             *  No?  : Pass null as Profile pic Id
             */
            else
            {
                if($prevPic = $id->photo)
                {
                    $photoId = $prevPic->id;
                }
                else
                {
                    $photoId = null;
                }
            }


            $speech = empty($request->speech) ? null : $request->speech;
            $facebook = empty($request->facebook) ? null : $request->facebook;
            $organisation_id = empty($request->organisation_id) ? null : $request->organisation_id;

            $id->update([
                'speaker' => $request->speaker,
                'speech' => $speech,
                'profession' => $request->profession,
                'batch' => $request->batch,
                'organisation_id' => $organisation_id,
                'email' => $request->email,
                'facebook' => $facebook,
                'department_id' => $request->department_id,
                'user_id' => $request->user_id,
                'photo_id' => $photoId
            ]);

            if($request->user()->isAdmin() || $request->user_id == $request->user()->id)
            {
                return back()->withNotification('Alumini has been updated')->withType('success');
            }
            else
            {
                return redirect()->route('alumini.index')->withNotification("Alumini has been updated");
            }
        }

        else {
            return redirect('/')->withNotification('You are not authorized')->withType('danger');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Alumini $alumini
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Alumini $alumini,Request $request)
    {
        if(!$request->user()->isSuperAdmin())
        {
            return back()->withNotification("Sorry! You are not authorized")->withType("danger");
        }

        $Pic = $alumini->photo;
        $alumini->delete();

        if ($Pic) {
            if(User::where('photo_id',$Pic->id)->first() == null) {
                $file = public_path('images/') . $Pic->url;
                if (File::exists($file)) {
                    // Delete from Storage
                    File::delete($file);
                    $Pic->delete();
                }
            }
        }
        return back()->withNotification("Success! Alumini deleted");
    }

}

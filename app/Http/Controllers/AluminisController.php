<?php

namespace App\Http\Controllers;

use App\Photo;
use Auth;
use Carbon\Carbon;
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
            $aluminis = $this->alumini->latest()->paginate();
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
                'profession' => 'required|min:5',
                'batch' => 'required|min:2',
                'organisation_id' => 'exists:organisations,id',
                'email' => 'required|email',
                'facebook' => '',
                'department_id' => 'required|exists:departments,id',
            ]);

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
            ]);

            return back()->withNotification('Alumini has been updated')->withType('success');
        }
        else {
            return redirect('/')->withNotification('You are not authorized')->withType('danger');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

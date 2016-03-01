<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisationRequest;
use App\Organisation;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrganisationsController extends Controller
{
    /**
     * @var Organisation
     */
    protected $organisation;

    /**
     * @param Organisation $organisation
     */
    public function __construct(Organisation $organisation)
    {
        $this->organisation = $organisation;
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('org.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('org.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrganisationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganisationRequest $request)
    {
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $photoName = md5(Carbon::now()).".".$request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('images'), $photoName);

                $photo = Photo::create([
                    'url' => $photoName
                ]);

                $slug = slug_for_url($request->name);

                $details = empty($request->details) ? null : $request->details;
                $initials = empty($request->initials) ? null : $request->initials;
                $address = empty($request->address) ? null : $request->address;

                $request->user()->organisations()->create([
                    'name' => $request->name,
                    'initials' => $initials,
                    'details' => $details,
                    'address' => $address,
                    'photo_id' => $photo->id,
                    'slug' => $slug,
                ]);

                return back()->withNotification('Organisation has been added!')->withType('success');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

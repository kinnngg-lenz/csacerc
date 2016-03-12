<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisationRequest;
use App\Organisation;
use App\Photo;
use App\User;
use Auth;
use Carbon\Carbon;
use File;
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
        $this->middleware('auth', ['except' => ['index', 'show', 'create' ,'store']]);
        $this->middleware('admin', ['except' => ['index', 'show', 'create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orgs = Organisation::orderBy('weight','DESC')->latest()->paginate();
        return view('org.index')->withOrgs($orgs);
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
        /**
         * If Photo is present then
         */
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $photoName = md5(Carbon::now()) . "." . $request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('images'), $photoName);

                $photo = Photo::create([
                    'url' => $photoName
                ]);

                $photoId = $photo->id;
            }
            // If Photo is Invalid then
            else {
                return back()->withNotification('Error! Photo Invalid!')->withType('danger');
            }
        }
        // Else set photo_id to null
        else {
            $photoId = null;
        }

                $slug = slug_for_url($request->name);

                $details = empty($request->details) ? null : $request->details;
                $initials = empty($request->initials) ? null : $request->initials;
                $address = empty($request->address) ? null : $request->address;

                if(Auth::check()) {
                    $request->user()->organisations()->create([
                        'name' => $request->name,
                        'initials' => $initials,
                        'details' => $details,
                        'address' => $address,
                        'photo_id' => $photoId,
                        'slug' => $slug,
                    ]);
                }
                // If not signed in then let it be added by the name of first user ie Zishan
                else
                {
                    $user = User::findOrFail(1);
                    $user->organisations()->create([
                        'name' => $request->name,
                        'initials' => $initials,
                        'details' => $details,
                        'address' => $address,
                        'photo_id' => $photoId,
                        'slug' => $slug,
                    ]);
                }
                return back()->withNotification('Organisation has been added!')->withType('success');
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
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $org = Organisation::findOrFail($id);

        if($request->user()->isSuperAdmin())
        {
            //If has Photo
            if(!is_null($org->photo))
            {
                $photo = $org->photo;

                $file = public_path('images/').$photo->url;
                if(File::exists($file))
                {
                    // Delete from Storage
                    File::delete($file);
                    $org->photo_id = null;
                    $org->save();
                    $photo->delete();
                }
            }
            $org->delete();
            return back()->withNotification("Organisation Deleted!")->withType('success');
        }
        return back()->withNotification("Sorry! You are not authorized.")->withType('danger');
    }
}

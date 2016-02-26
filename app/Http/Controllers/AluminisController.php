<?php

namespace App\Http\Controllers;

use Auth;
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
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('aluminis.index')->withAluminis($this->alumini->latest()->paginate(10));
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
        $slug = slug_for_url($request->speech, ' by '.$request->speaker);
        $request->user()->aluminis()->create([
                'speech' => $request->speech,
                'speaker' => $request->speaker,
                'batch' => $request->batch,
                'profession' => $request->profession,
                'slug' => $slug,
            ]);
        return back()->withNotification('A New Alumini has been created successfully!')->withType('success');

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

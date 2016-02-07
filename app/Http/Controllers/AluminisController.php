<?php

namespace App\Http\Controllers;

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
        $request->user()->aluminis()->create(
            $request->only('speech', 'speaker', 'batch', 'profession')
        );
        return back()->withNotification('A New Alumini has been created successfully!');

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

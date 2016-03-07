<?php

namespace App\Http\Controllers;

use App\Events\ShoutWasFired;
use App\Shout;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShoutsController extends Controller
{
    /**
     * ShoutsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'shout' => 'required|max:160',
        ]);

        $request->user()->shouts()->create([
            'shout' => $request->shout
        ]);

        return back();*/


        $validator = \Validator::make($request->all(), [
            'shout' => 'required|max:1'
        ]);

        /**
         * Try validating the request
         * If validation failed
         * Return the validator's errors with 422 HTTP status code
         */
        if ($validator->fails())
        {
            return ($validator->messages());
        }

        $shout = $request->user()->shouts()->create([
            'shout' => $request->shout
        ]);

        // fire Shout Added event if shout successfully added to database
        if($shout)
        {
            event(new ShoutWasFired($shout));
            return ['success' => true];
        }

        return ['error' => true];
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

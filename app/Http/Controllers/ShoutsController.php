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
            'shout' => 'required|max:500'
        ]);

        /**
         * Try validating the request
         * If validation failed
         * Return the validator's errors with 422 HTTP status code
         */
        if ($validator->fails())
        {
            return response($validator->messages(), 422);
        }

        $shout = $request->user()->shouts()->create([
            'shout' => $request->shout
        ]);

        // fire Shout Added event if shout successfully added to database
        event(new ShoutWasFired($shout));

        return response($shout, 201);
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
    public function destroy($id,Request $request)
    {
        $shout = Shout::findOrFail($id);
        if($request->user()->can('delete',$shout))
        {
            $shout->delete();
            return back()->withNotification("Success! Shout deleted")->withType("success");
        }
        else
        {
            return back()->withNotification("Sorry! You are not authorized for that action")->withType("Danger");
        }
    }
}

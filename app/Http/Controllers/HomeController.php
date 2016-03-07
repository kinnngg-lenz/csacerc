<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Shout;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $messages = $request->user()->receivedMessages()->with('sender')->with('receiver')->latest()->groupBy('sender_id')->get();

        $shouts = Shout::limit(15)->latest()->get();

        $shouts = $shouts->sortBy('created_at');

        return view('home')->withMessages($messages)->withShouts($shouts);
    }
}
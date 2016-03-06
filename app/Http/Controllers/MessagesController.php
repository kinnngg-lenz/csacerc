<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;

class MessagesController extends Controller
{
    /**
     * MessagesController constructor.
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MessageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($username,MessageRequest $request)
    {
        $receiver = User::findOrFailByUsername($username);
        $m = $request->user()->messages()->create([
            'message' => $request->message,
            'receiver_id' => $receiver->id
        ]);

        if($m)
        {
            return redirect()->route('messages.show',$receiver->username)->withNotification("Message Sent");
        }

        return back()->withNotification("Error! Unknown error occured!")->withType('danger');
    }

    public function start(Request $request)
    {
        $with = User::whereUsername($request->with)->orWhere('email', $request->with)->firstOrFail();
        return redirect()->route('messages.show',$with->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username, Request $request)
    {
        $user = User::findOrFailByUsername($username);

        $messages = Message::conversation($user,$request->user())->latest()->paginate(20);

        return view('messages.show')->withMessages($messages)->withRecuser($user);
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

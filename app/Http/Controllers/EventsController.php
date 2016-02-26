<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventsRequest;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
     * @var Event
     */
    protected $event;

    /**
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('events.index')->withEvents($this->event->with('photo')->orderBy('date', 'DESC')->paginate(10));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * @param EventsRequest $request
     * @return mixed
     */
    public function store(EventsRequest $request)
    {
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $photoName = md5(Carbon::now()).".".$request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('images'), $photoName);

                $photo = Photo::create([
                    'url' => $photoName
                ]);

                $slug = slug_for_url($request->name.' '.Carbon::parse($request->date)->diffForHumans());

                $request->user()->events()->create([
                    'name' => $request->name,
                    'date' => $request->date,
                    'description' => $request->description,
                    'venue' => $request->venue,
                    'photo_id' => $photo->id,
                    'slug' => $slug,
                ]);

                return back()->withNotification('Event has been created!')->withType('success');
            }
        }
    }

    /**
     * @param $slug
     */
    public function show($slug)
    {
        $event = Event::whereSlug($slug)->firstorFail();
        dd($event);
        return view('events.show')->withEvent($event);
    }

}

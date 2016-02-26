<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\News;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Photo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * @var News
     */
    protected $news;

    /**
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->news = $news;
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('news.index')->withAllnews($this->news->with('photo')->with('user')->latest()->paginate(10));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * @param NewsRequest $request
     * @return mixed
     */
    public function store(NewsRequest $request)
    {
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $photoName = md5(Carbon::now()).".".$request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('images'), $photoName);

                $photo = Photo::create([
                    'url' => $photoName
                ]);

                $slug = slug_for_url($request->title);

                $request->user()->news()->create([
                    'title' => $request->title,
                    'type' => $request->type,
                    'description' => $request->description,
                    'photo_id' => $photo->id,
                    'slug' => $slug,
                ]);

                return back()->withNotification('News has been created!')->withType('success');
            }
        }
    }

    /**
     * @param $slug
     */
    public function show($slug)
    {
        $news = News::whereSlug($slug)->firstorFail();
        dd($news);
        return view('news.show')->withEvent($news);
    }
}

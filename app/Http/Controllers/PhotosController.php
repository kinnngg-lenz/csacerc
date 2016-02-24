<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Photo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{
    /**
     * @var Photo
     */
    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'thumbnail']]);
        $this->middleware('admin', ['except' => ['index', 'show', 'thumbnail']]);
        $this->photo = $photo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = ($this->photo->getGallery()->latest()->paginate(20));

        return view('gallery.index')->withImages($images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $photoName = md5(Carbon::now()).".".$request->file('photo')->getClientOriginalExtension();

                $request->file('photo')->move(public_path('images'), $photoName);

                $photo = Photo::create([
                    'url' => $photoName,
                    'gallery' => 1
                ]);

                return back()->withNotification('Success! Image has been added to gallery.');
            }
            return back()->withNotification('Error! Something went wrong.');
        }
        return back()->withNotification('Error! Something went wrong.');
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

    public function thumbnail($url,$width=500)
    {
        $image = Image::make(public_path().'/images/'.$url);

        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $new = new \Intervention\Image\Response($image,null,100);
        return $new->make();
    }
}

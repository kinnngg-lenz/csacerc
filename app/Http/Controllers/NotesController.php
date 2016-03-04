<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesRequest;
use App\Note;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'download']]);
        $this->middleware('admin', ['except' => ['index', 'show', 'download']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::with('department')->orderBy('semester')->latest()->paginate();
        return view('notes.index')->withNotes($notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotesRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotesRequest $request)
    {
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $fileName = md5(Carbon::now()).".".$request->file('file')->getClientOriginalExtension();

                $request->file('file')->move(storage_path('pdf'), $fileName);

                $slug = slug_for_url($request->name." by ".$request->owner." semester ".$request->semester);

                $request->user()->notes()->create([
                    'name' => $request->name,
                    'url' => $fileName,
                    'semester' => $request->semester,
                    'department_id' => $request->department_id,
                    'college_id' => $request->college_id,
                    'owner' => $request->owner,
                    'slug' => $slug,
                ]);

                return back()->withNotification('Notes has been added!')->withType('success');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $notes = Note::whereSlug($slug)->first();

        if(is_null($notes))
            abort(404);

        $file = storage_path('pdf/').$notes->url;
        if(File::isFile($file))
        {
            $file = File::get($file);
            $response = Response::make($file,200);
            $response->header('Content-Type','application/pdf');

            return $response;
        }
        return back()->withNotification('Error! Something Wrong')->withType('danger');
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

    /**
     * @TODO:Fix this download link
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $note = Note::findOrFail($id);
        return \Response::download(storage_path('pdf/').$note->url,$note->name.".pdf",['Content-Type' => 'document/pdf']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Newsletter;
use Response;


class NewsletterController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('newsletter.index');
    }

    public function subscribe(NewsletterRequest $request)
    {
        $subs = Newsletter::subscribe($request->subscriber_email);

        if($subs)
        {
            return back()->withNotification('You have subscribed successfully! Check your email for confirmation.')->withType('success');
        }
        return back()->withNotification('Error! We are working to fix it.')->withType('danger');
    }

    /**
     * @param $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $file = storage_path('pdf/') . "{$name}.pdf";
        if (File::isFile($file)) {
            $file = File::get($file);
            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');

            return $response;
        }
        return back()->withNotification('Error! Something Wrong')->withType('danger');
    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($name)
    {
        $file = storage_path('pdf/') . "{$name}.pdf";
        if(File::exists($file))
        {
            return Response::download($file, $name.".pdf",['Content-Type' => 'document/pdf']);
        }
        else
        {
            return back()->withNotification('Error! File Not Found')->withType('danger');
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Newsletter;


class NewsletterController extends Controller
{
    public function __construct()
    {

    }

    public function subscribe(NewsletterRequest $request)
    {
        $subs = Newsletter::subscribe($request->email);

        if($subs)
        {
            return back()->withNotification('You have subscribed successfully! Check your email for confirmation.');
        }
        return back()->withNotification('Error! We are working to fix it.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotesRequest;
use App\Quote;
use Cache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuotesController extends Controller
{
    /**
     * @var Quote
     */
    private $quotes;

    /**
     * QuotesController constructor.
     */
    public function __construct(Quote $quotes)
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->quotes = $quotes;
    }

    public function index()
    {
        $quotes = $this->quotes->latest()->paginate();
        return view('quotes.index')->withQuotes($quotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotes.create');
    }

    /**
     * @param QuotesRequest $request
     * @return mixed
     */
    public function store(QuotesRequest $request)
    {
        $slug = slug_for_url($request->text, ' by '.$request->speaker);

        if($request->speaker == null || $request->speaker == "")
        {
            $speaker = null;
        }
        else
        {
            $speaker = $request->speaker;
        }

        /**
         * If Super admin then only for approved or unapproved
         */
        $approved = false;

        if($request->user()->isSuperAdmin())
        {
            if($request->has('approved'))
                $approved = true;
            else
                $approved = false;
        }


        $request->user()->quotes()->create([
            'text' => $request->text,
            'speaker' => $speaker,
            'slug' => $slug,
            'approved' => $approved
        ]);

        return back()->withNotification('Quote has been created successfully!')->withType('success');
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        $quote = $this->quotes->findOrFail($id);

        if($request->user()->cannot('edit', $quote))
        {
            return redirect("/")->withNotification("Sorry Buddy! You are not authorized.")->withType('danger');;
        }

        return view('quotes.edit')->withQuote($quote);
    }

    /**
     * Update Quotes
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $quote = $this->quotes->findOrFail($id);

        if($request->user()->cannot('edit', $quote))
        {
            return redirect('/')->withNotification("Sorry Buddy! You are not authorized.")->withType('danger');;
        }

        $this->validate($request, [
            'text' => 'required',
            'speaker' => '',
        ]);

        $speaker = empty($request->speaker) ? null : $request->speaker;

        /**
         * If Super admin then only for approved or unapproved
         */
        if($request->user()->isSuperAdmin())
        {
            if($request->has('approved'))
                $approved = true;
            else
                $approved = false;

            $quote->approved = $approved;
        }

        $quote->text = $request->text;
        $quote->speaker = $speaker;
        $quote->save();

        return back()->withNotification("Success! Quote Updated.");

    }

    /**
     * Put a Quote into Quote of the day Cache (qotd)
     *
     * @param $id
     * @param Request $request
     * @return
     */
    public function setasqotd($id,Request $request)
    {
        $quote = $this->quotes->findOrFail($id);

        if($request->user()->isSuperAdmin())
        {
            Cache::put('qotd',$quote,60*24);

            return back()->withNotification("Quote has been set as Quote of the Day");
        }

        return redirect('/')->withNotification("Error! Unauthorized access")->withType("danger");
    }

}

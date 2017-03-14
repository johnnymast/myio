<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitUrlRequest;
use Illuminate\Http\Request;
use App\Link;
use App\Hit;
use Illuminate\Support\Facades\Auth;

class SystemController extends Controller
{

    /**
     * Log the hit and redirect to the url.
     * @param Request $request
     * @param Link    $link
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show(Request $request, Link $link)
    {
        Hit::create([
            'ip' => $request->ip(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
            'link_id' => $link->id,
        ]);

        return redirect($link->url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubmitUrlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmitUrlRequest $request)
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        $link = Link::generate($request->url, $user_id);

        $html_link = '<a href="/'.$link->hash.'">Try it now</a>';

        return \Redirect::route('url_create')
            ->with('message', 'Url added created! '.$html_link);
    }
}

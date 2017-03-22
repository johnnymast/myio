<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitUrlRequest;
use App\Link;

class SystemController extends Controller
{
    /**
     * Log the hit and redirect to the url.
     *
     * @param Link $link
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show(Link $link)
    {
        $link->hits()->create([
            'ip' => request()->ip(),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
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
        return view('dashboard.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubmitUrlRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SubmitUrlRequest $request, Link $link)
    {
        // Todo checking for failure here.

        $link = $link->generate($request->url, auth()->user());

        $html_link = '<a href="/'.$link->hash.'">Try it now</a>';

        return redirect()->route('url_create')->with('message', 'Url added created! '.$html_link);
    }
}

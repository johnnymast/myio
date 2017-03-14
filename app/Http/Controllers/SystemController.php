<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\Hit;

class SystemController extends Controller
{

    /**
     * Log the hit and redirect to the url.
     *
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
}

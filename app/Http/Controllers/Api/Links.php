<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Link;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Links extends Controller
{

    use Helpers;


    /**
     * Return all links created by the
     * authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth()->user()->links->toArray();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Link $link)
    {
        $validator = Validator::make($request->all(),
            ['url' => 'required_without_all:urls', 'urls' => 'required_without_all:url']);
        if ($validator->fails()) {
            throw new StoreResourceFailedException ($validator->message());
        };

        $user = $request->user();

        if ($request->has('url')) {
            $item = $link->generate($request->url, $user);

            return $item;
        } else {
            if ($request->has('urls')) {
                $items = collect($request->urls)->each(function ($url) use ($user, $link) {
                    return $link->generate($url, $user);
                });

                return $items;
            }
        }
    }


    /**
     * Return one single link
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Auth()->user()->links->where('id', $id)->first());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::find($id);

        if ($link) {
            $link->delete();

            return $this->response->accepted();
        }

        return $this->response->errorNotFound('Link not found');
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Link;
use App\Transformers\LinkTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{

    use Helpers;


    /**
     * Return all links created by the
     * authenticated user.
     *
     * Status codes:
     *  200 - OK
     *  204 - No Content
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \Illuminate\Support\Collection $links */
        $links = auth()->user()->links()->get();

        if ($links->isEmpty()) {
            return $this->response->noContent();
        }

        // FIXME
        return $links->toArray();

        return $this->response->collection($links, new LinkTransformer);
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
        /** @var \Illuminate\Validation\Factory $validator */
        $validator = Validator::make($request->all(), [
                'url'  => 'required_without_all:urls',
                'urls' => 'required_without_all:url'
            ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException ($validator->message());
        };

        if ($request->has('url')) {
            $item = $link->generate($request->url, $request->user);

            return $item;
        } else {
            if ($request->has('urls')) {

                //return collect($request->urls)->each(function ($url) use ($request->user, $link) {
                //    return $link->generate($url, $request->user);
                //});
            }
        }
    }


    /**
     * Return one single link
     *
     * Status codes:
     *  200 - OK
     *  204 - No Content
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        $user = Auth()->user();
        if ( ! $user->link) {
            $this->response->errorNotFound();
        }

        /** @var \App\Link $item */
        $item = Auth()->user()->link->get()->find($id);

        return $this->response->item($item, new LinkTransformer());
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
        /** @var \App\Link $link */
        $link = Link::find($id);

        if ($link) {
            $link->delete();

            return $this->response->accepted();
        }

        $this->response->errorNotFound('Link not found');
    }
}

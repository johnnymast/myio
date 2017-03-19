<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Link;
use App\Transformers\LinkTransformer;
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

        return $this->response->collection($links, new LinkTransformer);
    }


    /**
     * Store a newly created resource in storage.
     *
     * Status codes:
     *  200 - OK
     *  204 - No Content
     *  400 - Bad Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Link $link)
    {
        $user = resolve('ApiUser');
        $link = resolve('App\Link');

        /** @var \Illuminate\Validation\Factory $validator */
        $validator = Validator::make(request()->all(), [
            'url'  => 'required_without_all:urls',
            'urls' => 'array|required_without_all:url'
        ]);

        if ($validator->fails()) {
            $this->response->errorBadRequest('Missing required parameters url or urls');
        };
// urls geen array
        if (request()->has('url')) {
            $item = $link->generate(request()->url, $user);
            return $this->response->item($item, new LinkTransformer())
                ->setStatusCode(201);
        } else {
            if (request()->has('urls')) {

                $collection = collect();
                foreach(request()->get('urls') as $url) {
                    $collection[] = $link->generate($url, $user);
                }

                return $this->response->collection($collection, new LinkTransformer)
                    ->setStatusCode(201);
            }
        }
    }


    /**
     * Return one single link
     *
     * Status codes:
     *  200 - OK
     *  404 - Not found
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        $user = resolve('ApiUser');

        if ( ! $user->hasLink($id)) {
            $this->response->errorNotFound();
        }

        return $this->response->item($user->getLink($id), new LinkTransformer());
    }


    /**
     * Remove the specified resource from storage.
     *
     * Status codes:
     *  200 - OK
     *  204 - No Content
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var \App\User $user */
        $user = resolve('ApiUser');

        if ( ! $user->hasLink($id)) {
            $this->response->errorNotFound();
        }

        $result = $user->getLink($id)->delete();

        if ($result) {
            return \Response::make('OK', 200);
        } else {
            $this->response->errorInternal('Could not delete link');
        }
    }
}

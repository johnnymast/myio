<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Transformers\LinkTransformer;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use App\Link;

/**
 *
 * @Resource("Links")
 */
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
     * @Get("/")
     * @Versions({"v1"})
     * @Response(200, body={"data": {"id": 10, "username": "foo"}})
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
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"url": "https://www.google.com", "urls[]": "https://www.google.com", "urls[]": "https://yahoo.com"})
     * @Transaction({
     *      @Request({"url": "https://www.google.com"}),
     *      @Response(201, body={"id": 10, "url": "https://www.google.com", "hash":"8928129"}),
     *      @Response(400, body={"error": "Missing required parameters url or urls"})
     * })
     *
     * @param Link $link
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

        if (request()->has('url')) {
            $item = $link->generate(request()->url, $user);

            return $this->response->item($item, new LinkTransformer())->setStatusCode(201);
        } else {
            if (request()->has('urls')) {

                $collection = collect();
                foreach (request()->get('urls') as $url) {
                    $collection[] = $link->generate($url, $user);
                }

                return $this->response->collection($collection, new LinkTransformer)->setStatusCode(201);
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
     * @Get("/")
     * @Versions({"v1"})
     * @Parameters({
     *      @Parameter("id", type="integer", required=true, description="The id of the url to retrieve", default=1)
     * })
     * @Transaction({
     *      @Request({"id": "10"}),
     *      @Response(201, body={"id": 10, "url": "https://www.google.com", "hash":"8928129"}),
     *      @Response(404, body={"error": "Not found"})
     * })
     *
     * @param int $id
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
     * @Delete("/")
     * @Versions({"v1"})
     * @Parameters({
     *      @Parameter("id", type="integer", required=true, description="The id of the url to delete", default=1)
     * })
     * @Response(200, body={"message": "OK"})
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\HitTransformer;
use Dingo\Api\Routing\Helpers;

/**
 * Return requested Link statistics.
 *
 * @Resource("Statistics")
 */

class StatisticsController extends Controller
{

    use Helpers;
    
    /**
     * Return all hits for a given link.
     *
     * Status codes:
     *  200 - OK
     *  204 - No Content
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Parameters({
     *      @Parameter("id", type="integer", required=true, description="The id of the link to retrieve statistics for", default=1)
     * })
     * @Transaction({
     *      @Request({"id": "10"}),
     *      @Response(200, body={"hits": {"id": 10, "ip": "12.0.0.1", "user_agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"}}),
     *      @Response(204, body={"message": "No content"})
     * })
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = resolve('ApiUser');

        if ( ! $user->hasLink($id)) {
            $this->response->errorNotFound();
        }

        if ( ! $user->getLink($id)->hits or $user->getLink($id)->hits->isEmpty()) {
            return $this->response->noContent();
        }

        return $this->response->item($user->getLink($id)->hits, new HitTransformer());
    }
}

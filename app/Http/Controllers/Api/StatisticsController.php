<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\HitTransformer;
use Dingo\Api\Routing\Helpers;

class StatisticsController extends Controller
{

    use Helpers;


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = resolve('\App\Contracts\ApiUser');
        if ( ! $user->hasLink($id)) {
            $this->response->errorNotFound();
        }
        if ( ! $user->getLink($id)->hits or $user->getLink($id)->hits->isEmpty()) {
            return $this->response->noContent();
        }

        return $this->response->item($user->getLink($id)->hits, new HitTransformer());
    }
}

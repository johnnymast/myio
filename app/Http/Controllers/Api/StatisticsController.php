<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = resolve('ApiUser');

        if ( ! $user->hasLink($id)) {
            $this->response->errorNotFound();
        }

        return $this->response->item($user->getLink($id)->hits, new LinkTransformer());
    }

}

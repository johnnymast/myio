<?php

namespace App\Transformers;

use App\Link;
use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param Link $link
     *
     * @return array
     */
    public function transform(Link $link)
    {
        return [
            'id'         => $link->id,
            'user_id'    => $user->user_id,
            'url'        => $user->url,
            'hash'       => $user->hash,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }
}
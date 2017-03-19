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
        return $link->toArray();
        return [
            'id'         => $link->id,
            'user_id'    => (int)$link->user_id,
            'url'        => $link->url,
            'hash'       => $link->hash,
            'created_at' => $link->created_at,
            'updated_at' => $link->updated_at,
        ];
    }
}
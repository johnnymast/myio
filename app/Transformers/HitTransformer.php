<?php

namespace App\Transformers;

use App\Hit;
use League\Fractal\TransformerAbstract;

class HitTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array.
     *
     * @param Hit $hit
     *
     * @return array
     */
    public function transform(Hit $hit)
    {
        return [
            'id'         => (int) $hit->id,
            'link_id'    => (int) $hit->user_id,
            'user_agent'        => $link->user_agent,
            'created_at'       => $link->hash,
            'created_at' => ($link->created_at) ? $link->created_at->toDateTimeString() : '',
            'updated_at' => ($link->updated_at) ? $link->updated_at->toDateTimeString() : '',
        ];
    }
}

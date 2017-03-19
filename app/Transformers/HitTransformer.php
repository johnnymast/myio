<?php

namespace App\Transformers;

use App\Hit;
use League\Fractal\TransformerAbstract;

class HitTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param Hit $hit
     *
     * @return array
     */
    public function transform(Hit $hit)
    {

        return [
            'id'         => (int)$hit->id,
            'link_id'    => (int)$hit->user_id,
            'ip'         => $hit->ip,
            'user_agent' => $hit->user_agent,
            'created_at' => ($hit->created_at) ? $hit->created_at->toDateTimeString() : '',
            'updated_at' => ($hit->updated_at) ? $hit->updated_at->toDateTimeString() : '',
        ];
    }
}
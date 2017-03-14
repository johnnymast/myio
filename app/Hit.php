<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'user_agent', 'link_id'
    ];


    /**
     * Return the link for this hit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function link() {
        return $this->hasOne('App\Link');
    }
}

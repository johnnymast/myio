<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'hash'
    ];


    /**
     * Generate a link with a unique hash.
     *
     * @see generateUniqueHash
     *
     * @param string $url
     *
     * @return mixed
     */
    public static function generate($url = '')
    {

        $hash = self::generateUniqueHash();
        $link = Link::create([
            'url'  => $url,
            'hash' => $hash,
        ]);

        return $link;
    }


    /**
     * Create a hash for this link to use.
     *
     * @return int
     */
    public static function generateUniqueHash()
    {
        $number = mt_rand(1000, 999999); // better than rand()

        if (self::whereHash($number)->exists()) {
            return self::generateUniqueHash();
        }

        return $number;
    }


    /**
     * Return the user for this link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Return the hits for this link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hits()
    {
        return $this->hasMany('App\Hit');
    }
}

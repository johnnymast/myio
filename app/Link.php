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
     * Create a unique_id for a new account to use.
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
}

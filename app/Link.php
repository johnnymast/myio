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
        'hash',
        'user_id'
    ];


    /**
     * Generate a link with a unique hash.
     *
     * @see generateUniqueHash
     * @param string $url
     * @param int    $user_id
     * @return mixed
     */
    public static function generate($url = '', $user_id = 0)
    {

        $hash = self::generateUniqueHash();
        $link = Link::create([
            'url'     => $url,
            'hash'    => $hash,
            'user_id' => $user_id,
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
        return $this->belongsTo(User::class);
    }


    /**
     * Return the hits for this link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hits()
    {
        return $this->hasMany(Hit::class);
    }
}

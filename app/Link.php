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
     * @see      generateUniqueHash
     *
     * @param string    $url
     * @param User|null $user
     *
     * @return mixed
     * @internal param int $user_id
     *
     */
    public function generate($url = '', User $user = null)
    {

        $hash = $this->generateUniqueHash();
        $data = [
            'url'  => $url,
            'hash' => $hash,
        ];

        /**
         * If the user_id has been offered
         * add the user_id so we can build
         * a relationship between link and
         * user.
         */
        if ($user) {
            $data['user_id'] = $user->id;
        }

        /**
         * Finally insert the link into
         * the database.
         */
        $link = Link::create($data);

        return $link;
    }


    /**
     * Create a hash for this link to use.
     *
     * @return int
     */
    private function generateUniqueHash()
    {
        $number = mt_rand(1000, 999999); // better than rand()

        if (self::whereHash($number)->exists()) {
            return $this->generateUniqueHash();
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
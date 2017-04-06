<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_token',
        'activated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Return the links for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany(Link::class);
    }

    /**
     * User is linked to a role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class)->withTimestamps();
    }

    /**
     * Check User role.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Assign user to role.
     *
     * @param $role
     */
    public function assignRole(Role $role)
    {
        $this->roles()->attach($role);
    }

    /**
     * Remove user role.
     *
     * @param $role
     *
     * @return int
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Create a unique email token.
     *
     * @return int
     */
    public function createEmailToken() {
        $token = str_random(config('myio.general.mail_token_length'));

        if (self::whereEmailToken($token)->exists()) {
            return $this->generateUniqueHash();
        }

        return $token;
    }

    /**
     * Verify a user.
     */
    public function verified()
    {
        $this->activated = 1;
        $this->email_token = null;
        $this->save();
    }
}

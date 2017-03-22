<?php

namespace App;

use App\Contracts\ApiUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements ApiUser
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
        'api_token',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class)->withTimestamps();
    }

    /**
     * @param int $id
     *
     * @return null
     */
    public function hasLink($id = 0)
    {
        return $this->getLink($id) != null;
    }

    /**
     * @param int $id
     *
     * @return null
     */
    public function getLink($id = 0)
    {
        if ($this->links) {
            return $this->links->find($id);
        }
    }

    /**
     * Check User role.
     *
     * @param string $name
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
     * @return int
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }
}

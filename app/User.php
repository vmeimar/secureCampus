<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first())
        {
            return true;
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first())
        {
            return true;
        }
        return false;
    }

}

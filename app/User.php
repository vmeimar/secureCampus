<?php

namespace App;

use App\Mail\NewUserRegisterMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Contract
 * @package App
 * @mixin Builder
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'tier', 'email', 'password'
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

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::created(function ($user) {
//            Mail::to($user->email)->send(new NewUserRegisterMail());
//        });
//    }

    public function sendWelcomeEmail(){

        $token = app('auth.password.broker')->createToken($this);;

        DB::table(config('auth.passwords.users.table'))->insert([
            'email' => $this->email,
            'token' => $token
        ]);

        $resetUrl= url(config('app.url').route('password.reset', $token, false));

        Mail::to($this)->send(new Welcome($this, $resetUrl));

    }

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

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

}

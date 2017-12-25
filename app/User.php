<?php

namespace App;

use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Traits\Ownership;
use App\Traits\ValidatesPassword;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, Ownership, ValidatesPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_update',
        'password',
        'avatar',
        'activation_code',
        'is_activated',
        'is_superadmin'
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
     * Automatically creates hash for the user activation code.
     *
     * @param string $value
     * @return void
     */
    public function setActivationCodeAttribute($value)
    {
        $this->attributes['activation_code'] = Hash::make($value);
    }

    /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get users posts
     *
     * @return Illuminate\Database\Eloquent\Collection void
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get user comments collection
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}

<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address',
        'postal_code',
        'city',
        'country_code',
        'phone',
    ];

    protected $hidden = [
        "password",
        "remember_token",
    ];

    public $timestamps = true;

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
}

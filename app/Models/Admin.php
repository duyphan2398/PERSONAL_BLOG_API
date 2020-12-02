<?php

namespace App\Models;

use App\Builders\AdminBuilder;
use App\Traits\HasUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasUuid;
    use \App\Traits\BaseModel;

    public function provideCustomBuilder()
    {
        return AdminBuilder::class;
    }


    protected $fillable = [
        'login_id',
        'name',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     *
     *
     * @return mixed|string
     */
    public function getAuthIdentifier()
    {
        return 'login_id';
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    // ======================================================================
    // Accessors & Mutators
    // ======================================================================

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}

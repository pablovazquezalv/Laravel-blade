<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'last_name',
        'email',
        'phone_number',
        'code', 
        'public_key',
        //'private_key',
        
        'email_verified_at',
        'status',
        'access_app',
        'password',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

        'password' => 'hashed',
    ];

    public function hasRole(int $role): bool
    {
        return $this->rol_id === $role;
    }

    public function statusActive(): bool
    {
        //si es bd mysql es 1
      // return $this->status === 1;

        //si es postgresql es true
        return $this->status === true;
    }

    public function isActive(): bool
    {
        //si es bd mysql es 1
        //return $this->access_app === 1;

        //si es postgresql es true
        return $this->is_active === true;
    }

    
}

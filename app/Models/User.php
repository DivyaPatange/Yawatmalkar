<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'employee_id',
        'username',
        'password',
        'password_1',
        'is_register',
        'status',
        'acc_type',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('acc_type', $roles)->first())
        {
            return true;
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if($this->roles()->where('acc_type', $role)->first())
        {
            return true;
        }
        return false;
    }
}

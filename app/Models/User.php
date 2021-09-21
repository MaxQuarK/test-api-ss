<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'manager_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function post()
    {
        return $this->hasMany('App\Models\Post', 'user_id', 'id');
    }

    public function manager()
    {
        return $this->hasOne('App\Models\User', 'id', 'manager_id');
    }

    public function employer()
    {
        return $this->belongsTo('App\Models\User', 'id', 'manager_id');
    }

    public function hasRole($role)
    {
        if ($this->role->title == $role) {
            return true;
        }

        return false;
    }

    public function assignRole($role)
    {
        $this->role->save($role);
    }
}

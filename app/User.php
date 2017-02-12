<?php

namespace App;

use App\Models\Piyes\User\HasRoles;
use App\Models\Piyes\User\Role;
use App\Models\Piyes\User\Setting;
use App\Models\Piyes\Loginlog;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * A user may have many roles
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * A user may have many login logs
    */
    public function logs()
    {
        return $this->hasMany(Loginlog::class);
    }

    /**
     * A user has unique settings
     */
    public function settings()
    {
        return $this->hasOne(Setting::class, 'user_id');
    }

    /**
     * A user has unique settings
     */
    public function isArchitect()
    {
        return $this->hasRole('Architect');
    }

    public function getRoleListAttribute(){
        return $this->roles->pluck('id')->all();
    }
}

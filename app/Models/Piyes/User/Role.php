<?php

namespace App\Models\Piyes\User;

use App\User;
use App\Models\Piyes\User\Permission;
use App\Models\Piyes\BaseModel;

class Role extends BaseModel
{
    protected $table = 'roles';
    protected $fillable = ['name', 'created_by', 'updated_by'];
    public static $rules = array(
        'name' => 'required|unique:roles',
    );
    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Grant the given permission to a role.
     *
     * @param  Permission $permission
     * @return mixed
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * An role may belong to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     *
     * Permission list of a role
     *
     */
    public function getPermissionListAttribute(){
        return $this->permissions->pluck('id')->all();
    }

    /**
     *
     * User list of a role
     *
     */
    public function getUserListAttribute(){
        return $this->users->pluck('id')->all();
    }

}

<?php

namespace App\Models\Piyes\User;

use App\Models\Piyes\User\Role;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
	protected $table = 'role_user';
    protected $fillable = ['role_id', 'user_id'];


	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}

}
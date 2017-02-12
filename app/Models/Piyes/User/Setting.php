<?php

namespace App\Models\Piyes\User;

use App\Models\Piyes\BaseModel;
use App\User;

class Setting extends BaseModel
{
	protected $table = 'user_settings';
    protected $fillable = ['user_id', 'isLocked', 'isSidebarClosed', 'showNotifications', 'language', 'profile_photo', 'created_by', 'updated_by'];
    public static $rules = array(
        'user_id' => 'required|unique:user_settings'
    );
    /**
     * A setting belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

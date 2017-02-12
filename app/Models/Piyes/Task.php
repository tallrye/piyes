<?php

namespace App\Models\Piyes;

use App\Models\Piyes\BaseModel;

class Task extends BaseModel
{
	protected $table = 'tasks';
    protected $fillable = ['description', 'isDone', 'position'];
}
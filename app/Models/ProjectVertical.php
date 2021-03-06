<?php

namespace App\Models;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Relations\Pivot;


class ProjectVertical extends Pivot
{

    public $table = 'project_vertical';


	public static function boot()
	{
		parent::boot();

		static::creating(function($model)
		{
			$model->user_id = Sentinel::getUser()->id;
		});
	}
}

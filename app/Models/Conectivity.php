<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


class Conectivity extends Model
{
    use SoftDeletes;

    public $table = 'conectivities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];


	public static function boot()
	{

		parent::boot();

		static::creating(function($model)
		{
			$model->user_id = Sentinel::getUser()->id;
		});
	}


	public function projects()
	{
		return $this->belongsToMany(Project::class)->withTimestamps();
	}
}

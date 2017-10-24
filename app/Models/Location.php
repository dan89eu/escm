<?php

namespace App\Models;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;



class Location extends Model
{

    public $table = 'locations';
    


    public $fillable = [
        'formatted_address',
        'county_name',
        'country_name',
        'locality_name',
	    'lat',
	    'lng',
	    'place_id'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'formatted_address' => 'string',
        'county_name' => 'string',
        'country_name' => 'string',
        'locality_name' => 'string',
        'place_id' => 'string',
        'slug' => 'string',
        'user_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'formatted_address' => 'required',
        'locality_name' => 'required',
        'lat' => 'required',
        'lng' => 'required',
        'place_id' => 'required',
        'user_id' => 'required'
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
		return $this->hasMany(Project::class)->withTimestamps();
	}
}

<?php

namespace App\Models;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;



class Project extends Model
{

    public $table = 'projects';
    


    public $fillable = [
        'name',
        'initialCost',
        'finalCost',
        'contracting_date',
        'eta_delivery_date',
        'final_delivery_date',
        'gps_location',
        'details',
        'notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'initialCost' => 'integer',
        'finalCost' => 'integer',
        'gps_location' => 'string',
        'details' => 'string',
        'notes' => 'string'
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

	public function verticals()
	{
		return $this->belongsToMany(Vertical::class)->withTimestamps();
	}

	public function beneficiaries()
	{
		return $this->belongsToMany(Beneficiary::class)->withTimestamps();
	}

	public function providers()
	{
		return $this->belongsToMany(Provider::class)->withTimestamps();
	}

	public function infrastructures()
	{
		return $this->belongsToMany(Infrastructure::class)->withTimestamps();
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}

	public function news()
	{
		return $this->hasMany(News::class);
	}

	public function location()
	{
		return $this->belongsTo(Location::class);
	}

	public function conectivities()
	{
		return $this->belongsToMany(Conectivity::class)->withTimestamps();
	}

}

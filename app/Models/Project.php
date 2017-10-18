<?php

namespace App\Models;

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
}

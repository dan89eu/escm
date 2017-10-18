<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Provider extends Model
{

    public $table = 'providers';
    


    public $fillable = [
        'name',
        'address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'address' => 'string'
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

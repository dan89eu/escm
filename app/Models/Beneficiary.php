<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Beneficiary extends Model
{

    public $table = 'beneficiaries';
    


    public $fillable = [
        'name',
        'address',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'user_id' => 'string'
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

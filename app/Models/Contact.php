<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Contact extends Model
{

    public $table = 'contacts';
    


    public $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'beneficiaries_id',
        'providers_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'department' => 'string',
        'beneficiaries_id' => 'integer',
        'providers_id' => 'integer',
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
}

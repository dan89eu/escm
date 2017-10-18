<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Image extends Model
{

    public $table = 'images';
    


    public $fillable = [
        'name',
        'path',
        'description',
        'project_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'path' => 'string',
        'description' => 'string',
        'project_id' => 'integer'
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class News extends Model
{

    public $table = 'news';
    


    public $fillable = [
        'name',
        'url',
        'description',
        'projects_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'url' => 'string',
        'description' => 'string',
        'projects_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'url' => 'required'
    ];
}

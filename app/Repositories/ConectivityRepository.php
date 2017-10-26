<?php

namespace App\Repositories;

use App\Models\Conectivity;
use InfyOm\Generator\Common\BaseRepository;

class ConectivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Conectivity::class;
    }
}

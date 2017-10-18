<?php

namespace App\Repositories;

use App\Models\Vertical;
use InfyOm\Generator\Common\BaseRepository;

class VerticalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vertical::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\Infrastructure;
use InfyOm\Generator\Common\BaseRepository;

class InfrastructureRepository extends BaseRepository
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
        return Infrastructure::class;
    }
}

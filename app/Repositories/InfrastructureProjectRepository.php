<?php

namespace App\Repositories;

use App\Models\InfrastructureProject;
use InfyOm\Generator\Common\BaseRepository;

class InfrastructureProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InfrastructureProject::class;
    }
}

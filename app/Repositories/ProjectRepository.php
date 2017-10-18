<?php

namespace App\Repositories;

use App\Models\Project;
use InfyOm\Generator\Common\BaseRepository;

class ProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return Project::class;
    }
}

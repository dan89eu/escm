<?php

namespace App\Repositories;

use App\Models\CategoryProject;
use InfyOm\Generator\Common\BaseRepository;

class CategoryProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'project_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryProject::class;
    }
}

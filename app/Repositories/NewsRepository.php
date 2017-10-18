<?php

namespace App\Repositories;

use App\Models\News;
use InfyOm\Generator\Common\BaseRepository;

class NewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'url',
        'description',
        'projects_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return News::class;
    }
}

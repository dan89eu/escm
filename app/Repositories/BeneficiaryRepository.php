<?php

namespace App\Repositories;

use App\Models\Beneficiary;
use InfyOm\Generator\Common\BaseRepository;

class BeneficiaryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Beneficiary::class;
    }
}

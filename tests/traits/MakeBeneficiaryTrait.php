<?php

use Faker\Factory as Faker;
use App\Models\Beneficiary;
use App\Repositories\BeneficiaryRepository;

trait MakeBeneficiaryTrait
{
    /**
     * Create fake instance of Beneficiary and save it in database
     *
     * @param array $beneficiaryFields
     * @return Beneficiary
     */
    public function makeBeneficiary($beneficiaryFields = [])
    {
        /** @var BeneficiaryRepository $beneficiaryRepo */
        $beneficiaryRepo = App::make(BeneficiaryRepository::class);
        $theme = $this->fakeBeneficiaryData($beneficiaryFields);
        return $beneficiaryRepo->create($theme);
    }

    /**
     * Get fake instance of Beneficiary
     *
     * @param array $beneficiaryFields
     * @return Beneficiary
     */
    public function fakeBeneficiary($beneficiaryFields = [])
    {
        return new Beneficiary($this->fakeBeneficiaryData($beneficiaryFields));
    }

    /**
     * Get fake data of Beneficiary
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBeneficiaryData($beneficiaryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'address' => $fake->word,
            'user_id' => $fake->word
        ], $beneficiaryFields);
    }
}

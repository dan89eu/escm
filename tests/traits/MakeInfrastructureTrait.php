<?php

use Faker\Factory as Faker;
use App\Models\Infrastructure;
use App\Repositories\InfrastructureRepository;

trait MakeInfrastructureTrait
{
    /**
     * Create fake instance of Infrastructure and save it in database
     *
     * @param array $infrastructureFields
     * @return Infrastructure
     */
    public function makeInfrastructure($infrastructureFields = [])
    {
        /** @var InfrastructureRepository $infrastructureRepo */
        $infrastructureRepo = App::make(InfrastructureRepository::class);
        $theme = $this->fakeInfrastructureData($infrastructureFields);
        return $infrastructureRepo->create($theme);
    }

    /**
     * Get fake instance of Infrastructure
     *
     * @param array $infrastructureFields
     * @return Infrastructure
     */
    public function fakeInfrastructure($infrastructureFields = [])
    {
        return new Infrastructure($this->fakeInfrastructureData($infrastructureFields));
    }

    /**
     * Get fake data of Infrastructure
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInfrastructureData($infrastructureFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word
        ], $infrastructureFields);
    }
}

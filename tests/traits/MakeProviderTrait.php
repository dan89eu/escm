<?php

use Faker\Factory as Faker;
use App\Models\Provider;
use App\Repositories\ProviderRepository;

trait MakeProviderTrait
{
    /**
     * Create fake instance of Provider and save it in database
     *
     * @param array $providerFields
     * @return Provider
     */
    public function makeProvider($providerFields = [])
    {
        /** @var ProviderRepository $providerRepo */
        $providerRepo = App::make(ProviderRepository::class);
        $theme = $this->fakeProviderData($providerFields);
        return $providerRepo->create($theme);
    }

    /**
     * Get fake instance of Provider
     *
     * @param array $providerFields
     * @return Provider
     */
    public function fakeProvider($providerFields = [])
    {
        return new Provider($this->fakeProviderData($providerFields));
    }

    /**
     * Get fake data of Provider
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProviderData($providerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'address' => $fake->word
        ], $providerFields);
    }
}

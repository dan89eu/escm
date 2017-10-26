<?php

use Faker\Factory as Faker;
use App\Models\Conectivity;
use App\Repositories\ConectivityRepository;

trait MakeConectivityTrait
{
    /**
     * Create fake instance of Conectivity and save it in database
     *
     * @param array $conectivityFields
     * @return Conectivity
     */
    public function makeConectivity($conectivityFields = [])
    {
        /** @var ConectivityRepository $conectivityRepo */
        $conectivityRepo = App::make(ConectivityRepository::class);
        $theme = $this->fakeConectivityData($conectivityFields);
        return $conectivityRepo->create($theme);
    }

    /**
     * Get fake instance of Conectivity
     *
     * @param array $conectivityFields
     * @return Conectivity
     */
    public function fakeConectivity($conectivityFields = [])
    {
        return new Conectivity($this->fakeConectivityData($conectivityFields));
    }

    /**
     * Get fake data of Conectivity
     *
     * @param array $postFields
     * @return array
     */
    public function fakeConectivityData($conectivityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->word,
            'user_id' => $fake->randomDigitNotNull
        ], $conectivityFields);
    }
}

<?php

use Faker\Factory as Faker;
use App\Models\Tt;
use App\Repositories\TtRepository;

trait MakeTtTrait
{
    /**
     * Create fake instance of Tt and save it in database
     *
     * @param array $ttFields
     * @return Tt
     */
    public function makeTt($ttFields = [])
    {
        /** @var TtRepository $ttRepo */
        $ttRepo = App::make(TtRepository::class);
        $theme = $this->fakeTtData($ttFields);
        return $ttRepo->create($theme);
    }

    /**
     * Get fake instance of Tt
     *
     * @param array $ttFields
     * @return Tt
     */
    public function fakeTt($ttFields = [])
    {
        return new Tt($this->fakeTtData($ttFields));
    }

    /**
     * Get fake data of Tt
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTtData($ttFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'ttt' => $fake->word
        ], $ttFields);
    }
}

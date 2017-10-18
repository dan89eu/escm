<?php

use Faker\Factory as Faker;
use App\Models\Vertical;
use App\Repositories\VerticalRepository;

trait MakeVerticalTrait
{
    /**
     * Create fake instance of Vertical and save it in database
     *
     * @param array $verticalFields
     * @return Vertical
     */
    public function makeVertical($verticalFields = [])
    {
        /** @var VerticalRepository $verticalRepo */
        $verticalRepo = App::make(VerticalRepository::class);
        $theme = $this->fakeVerticalData($verticalFields);
        return $verticalRepo->create($theme);
    }

    /**
     * Get fake instance of Vertical
     *
     * @param array $verticalFields
     * @return Vertical
     */
    public function fakeVertical($verticalFields = [])
    {
        return new Vertical($this->fakeVerticalData($verticalFields));
    }

    /**
     * Get fake data of Vertical
     *
     * @param array $postFields
     * @return array
     */
    public function fakeVerticalData($verticalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'user_id' => $fake->randomDigitNotNull
        ], $verticalFields);
    }
}

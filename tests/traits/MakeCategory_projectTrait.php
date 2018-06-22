<?php

use Faker\Factory as Faker;
use App\Models\Category_project;
use App\Repositories\Category_projectRepository;

trait MakeCategory_projectTrait
{
    /**
     * Create fake instance of Category_project and save it in database
     *
     * @param array $categoryProjectFields
     * @return Category_project
     */
    public function makeCategory_project($categoryProjectFields = [])
    {
        /** @var Category_projectRepository $categoryProjectRepo */
        $categoryProjectRepo = App::make(Category_projectRepository::class);
        $theme = $this->fakeCategory_projectData($categoryProjectFields);
        return $categoryProjectRepo->create($theme);
    }

    /**
     * Get fake instance of Category_project
     *
     * @param array $categoryProjectFields
     * @return Category_project
     */
    public function fakeCategory_project($categoryProjectFields = [])
    {
        return new Category_project($this->fakeCategory_projectData($categoryProjectFields));
    }

    /**
     * Get fake data of Category_project
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCategory_projectData($categoryProjectFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'project_id' => $fake->randomDigitNotNull,
            'user_id' => $fake->randomDigitNotNull
        ], $categoryProjectFields);
    }
}

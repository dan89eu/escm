<?php

use Faker\Factory as Faker;
use App\Models\CategoryProject;
use App\Repositories\CategoryProjectRepository;

trait MakeCategoryProjectTrait
{
    /**
     * Create fake instance of CategoryProject and save it in database
     *
     * @param array $categoryProjectFields
     * @return CategoryProject
     */
    public function makeCategoryProject($categoryProjectFields = [])
    {
        /** @var CategoryProjectRepository $categoryProjectRepo */
        $categoryProjectRepo = App::make(CategoryProjectRepository::class);
        $theme = $this->fakeCategoryProjectData($categoryProjectFields);
        return $categoryProjectRepo->create($theme);
    }

    /**
     * Get fake instance of CategoryProject
     *
     * @param array $categoryProjectFields
     * @return CategoryProject
     */
    public function fakeCategoryProject($categoryProjectFields = [])
    {
        return new CategoryProject($this->fakeCategoryProjectData($categoryProjectFields));
    }

    /**
     * Get fake data of CategoryProject
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCategoryProjectData($categoryProjectFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'category_id' => $fake->randomDigitNotNull,
            'project_id' => $fake->randomDigitNotNull,
            'user_id' => $fake->randomDigitNotNull
        ], $categoryProjectFields);
    }
}

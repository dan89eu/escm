<?php

use Faker\Factory as Faker;
use App\Models\Project;
use App\Repositories\ProjectRepository;

trait MakeProjectTrait
{
    /**
     * Create fake instance of Project and save it in database
     *
     * @param array $projectFields
     * @return Project
     */
    public function makeProject($projectFields = [])
    {
        /** @var ProjectRepository $projectRepo */
        $projectRepo = App::make(ProjectRepository::class);
        $theme = $this->fakeProjectData($projectFields);
        return $projectRepo->create($theme);
    }

    /**
     * Get fake instance of Project
     *
     * @param array $projectFields
     * @return Project
     */
    public function fakeProject($projectFields = [])
    {
        return new Project($this->fakeProjectData($projectFields));
    }

    /**
     * Get fake data of Project
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProjectData($projectFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'initialCost' => $fake->randomDigitNotNull,
            'finalCost' => $fake->randomDigitNotNull,
            'contracting_date' => $fake->word,
            'eta_delivery_date' => $fake->word,
            'final_delivery_date' => $fake->word,
            'gps_location' => $fake->text,
            'details' => $fake->text,
            'notes' => $fake->text
        ], $projectFields);
    }
}

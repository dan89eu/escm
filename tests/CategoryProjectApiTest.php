<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryProjectApiTest extends TestCase
{
    use MakeCategoryProjectTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategoryProject()
    {
        $categoryProject = $this->fakeCategoryProjectData();
        $this->json('POST', '/api/v1/categoryProjects', $categoryProject);

        $this->assertApiResponse($categoryProject);
    }

    /**
     * @test
     */
    public function testReadCategoryProject()
    {
        $categoryProject = $this->makeCategoryProject();
        $this->json('GET', '/api/v1/categoryProjects/'.$categoryProject->id);

        $this->assertApiResponse($categoryProject->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategoryProject()
    {
        $categoryProject = $this->makeCategoryProject();
        $editedCategoryProject = $this->fakeCategoryProjectData();

        $this->json('PUT', '/api/v1/categoryProjects/'.$categoryProject->id, $editedCategoryProject);

        $this->assertApiResponse($editedCategoryProject);
    }

    /**
     * @test
     */
    public function testDeleteCategoryProject()
    {
        $categoryProject = $this->makeCategoryProject();
        $this->json('DELETE', '/api/v1/categoryProjects/'.$categoryProject->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categoryProjects/'.$categoryProject->id);

        $this->assertResponseStatus(404);
    }
}

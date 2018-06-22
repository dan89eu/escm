<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Category_projectApiTest extends TestCase
{
    use MakeCategory_projectTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategory_project()
    {
        $categoryProject = $this->fakeCategory_projectData();
        $this->json('POST', '/api/v1/categoryProjects', $categoryProject);

        $this->assertApiResponse($categoryProject);
    }

    /**
     * @test
     */
    public function testReadCategory_project()
    {
        $categoryProject = $this->makeCategory_project();
        $this->json('GET', '/api/v1/categoryProjects/'.$categoryProject->id);

        $this->assertApiResponse($categoryProject->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategory_project()
    {
        $categoryProject = $this->makeCategory_project();
        $editedCategory_project = $this->fakeCategory_projectData();

        $this->json('PUT', '/api/v1/categoryProjects/'.$categoryProject->id, $editedCategory_project);

        $this->assertApiResponse($editedCategory_project);
    }

    /**
     * @test
     */
    public function testDeleteCategory_project()
    {
        $categoryProject = $this->makeCategory_project();
        $this->json('DELETE', '/api/v1/categoryProjects/'.$categoryProject->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categoryProjects/'.$categoryProject->id);

        $this->assertResponseStatus(404);
    }
}

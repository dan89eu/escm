<?php

use App\Models\Category_project;
use App\Repositories\Category_projectRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Category_projectRepositoryTest extends TestCase
{
    use MakeCategory_projectTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Category_projectRepository
     */
    protected $categoryProjectRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categoryProjectRepo = App::make(Category_projectRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategory_project()
    {
        $categoryProject = $this->fakeCategory_projectData();
        $createdCategory_project = $this->categoryProjectRepo->create($categoryProject);
        $createdCategory_project = $createdCategory_project->toArray();
        $this->assertArrayHasKey('id', $createdCategory_project);
        $this->assertNotNull($createdCategory_project['id'], 'Created Category_project must have id specified');
        $this->assertNotNull(Category_project::find($createdCategory_project['id']), 'Category_project with given id must be in DB');
        $this->assertModelData($categoryProject, $createdCategory_project);
    }

    /**
     * @test read
     */
    public function testReadCategory_project()
    {
        $categoryProject = $this->makeCategory_project();
        $dbCategory_project = $this->categoryProjectRepo->find($categoryProject->id);
        $dbCategory_project = $dbCategory_project->toArray();
        $this->assertModelData($categoryProject->toArray(), $dbCategory_project);
    }

    /**
     * @test update
     */
    public function testUpdateCategory_project()
    {
        $categoryProject = $this->makeCategory_project();
        $fakeCategory_project = $this->fakeCategory_projectData();
        $updatedCategory_project = $this->categoryProjectRepo->update($fakeCategory_project, $categoryProject->id);
        $this->assertModelData($fakeCategory_project, $updatedCategory_project->toArray());
        $dbCategory_project = $this->categoryProjectRepo->find($categoryProject->id);
        $this->assertModelData($fakeCategory_project, $dbCategory_project->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategory_project()
    {
        $categoryProject = $this->makeCategory_project();
        $resp = $this->categoryProjectRepo->delete($categoryProject->id);
        $this->assertTrue($resp);
        $this->assertNull(Category_project::find($categoryProject->id), 'Category_project should not exist in DB');
    }
}

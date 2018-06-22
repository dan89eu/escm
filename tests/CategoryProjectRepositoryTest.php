<?php

use App\Models\CategoryProject;
use App\Repositories\CategoryProjectRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryProjectRepositoryTest extends TestCase
{
    use MakeCategoryProjectTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoryProjectRepository
     */
    protected $categoryProjectRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categoryProjectRepo = App::make(CategoryProjectRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategoryProject()
    {
        $categoryProject = $this->fakeCategoryProjectData();
        $createdCategoryProject = $this->categoryProjectRepo->create($categoryProject);
        $createdCategoryProject = $createdCategoryProject->toArray();
        $this->assertArrayHasKey('id', $createdCategoryProject);
        $this->assertNotNull($createdCategoryProject['id'], 'Created CategoryProject must have id specified');
        $this->assertNotNull(CategoryProject::find($createdCategoryProject['id']), 'CategoryProject with given id must be in DB');
        $this->assertModelData($categoryProject, $createdCategoryProject);
    }

    /**
     * @test read
     */
    public function testReadCategoryProject()
    {
        $categoryProject = $this->makeCategoryProject();
        $dbCategoryProject = $this->categoryProjectRepo->find($categoryProject->id);
        $dbCategoryProject = $dbCategoryProject->toArray();
        $this->assertModelData($categoryProject->toArray(), $dbCategoryProject);
    }

    /**
     * @test update
     */
    public function testUpdateCategoryProject()
    {
        $categoryProject = $this->makeCategoryProject();
        $fakeCategoryProject = $this->fakeCategoryProjectData();
        $updatedCategoryProject = $this->categoryProjectRepo->update($fakeCategoryProject, $categoryProject->id);
        $this->assertModelData($fakeCategoryProject, $updatedCategoryProject->toArray());
        $dbCategoryProject = $this->categoryProjectRepo->find($categoryProject->id);
        $this->assertModelData($fakeCategoryProject, $dbCategoryProject->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategoryProject()
    {
        $categoryProject = $this->makeCategoryProject();
        $resp = $this->categoryProjectRepo->delete($categoryProject->id);
        $this->assertTrue($resp);
        $this->assertNull(CategoryProject::find($categoryProject->id), 'CategoryProject should not exist in DB');
    }
}

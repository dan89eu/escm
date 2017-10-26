<?php

use App\Models\Conectivity;
use App\Repositories\ConectivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConectivityRepositoryTest extends TestCase
{
    use MakeConectivityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConectivityRepository
     */
    protected $conectivityRepo;

    public function setUp()
    {
        parent::setUp();
        $this->conectivityRepo = App::make(ConectivityRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateConectivity()
    {
        $conectivity = $this->fakeConectivityData();
        $createdConectivity = $this->conectivityRepo->create($conectivity);
        $createdConectivity = $createdConectivity->toArray();
        $this->assertArrayHasKey('id', $createdConectivity);
        $this->assertNotNull($createdConectivity['id'], 'Created Conectivity must have id specified');
        $this->assertNotNull(Conectivity::find($createdConectivity['id']), 'Conectivity with given id must be in DB');
        $this->assertModelData($conectivity, $createdConectivity);
    }

    /**
     * @test read
     */
    public function testReadConectivity()
    {
        $conectivity = $this->makeConectivity();
        $dbConectivity = $this->conectivityRepo->find($conectivity->id);
        $dbConectivity = $dbConectivity->toArray();
        $this->assertModelData($conectivity->toArray(), $dbConectivity);
    }

    /**
     * @test update
     */
    public function testUpdateConectivity()
    {
        $conectivity = $this->makeConectivity();
        $fakeConectivity = $this->fakeConectivityData();
        $updatedConectivity = $this->conectivityRepo->update($fakeConectivity, $conectivity->id);
        $this->assertModelData($fakeConectivity, $updatedConectivity->toArray());
        $dbConectivity = $this->conectivityRepo->find($conectivity->id);
        $this->assertModelData($fakeConectivity, $dbConectivity->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteConectivity()
    {
        $conectivity = $this->makeConectivity();
        $resp = $this->conectivityRepo->delete($conectivity->id);
        $this->assertTrue($resp);
        $this->assertNull(Conectivity::find($conectivity->id), 'Conectivity should not exist in DB');
    }
}

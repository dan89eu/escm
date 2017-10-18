<?php

use App\Models\Infrastructure;
use App\Repositories\InfrastructureRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InfrastructureRepositoryTest extends TestCase
{
    use MakeInfrastructureTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InfrastructureRepository
     */
    protected $infrastructureRepo;

    public function setUp()
    {
        parent::setUp();
        $this->infrastructureRepo = App::make(InfrastructureRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInfrastructure()
    {
        $infrastructure = $this->fakeInfrastructureData();
        $createdInfrastructure = $this->infrastructureRepo->create($infrastructure);
        $createdInfrastructure = $createdInfrastructure->toArray();
        $this->assertArrayHasKey('id', $createdInfrastructure);
        $this->assertNotNull($createdInfrastructure['id'], 'Created Infrastructure must have id specified');
        $this->assertNotNull(Infrastructure::find($createdInfrastructure['id']), 'Infrastructure with given id must be in DB');
        $this->assertModelData($infrastructure, $createdInfrastructure);
    }

    /**
     * @test read
     */
    public function testReadInfrastructure()
    {
        $infrastructure = $this->makeInfrastructure();
        $dbInfrastructure = $this->infrastructureRepo->find($infrastructure->id);
        $dbInfrastructure = $dbInfrastructure->toArray();
        $this->assertModelData($infrastructure->toArray(), $dbInfrastructure);
    }

    /**
     * @test update
     */
    public function testUpdateInfrastructure()
    {
        $infrastructure = $this->makeInfrastructure();
        $fakeInfrastructure = $this->fakeInfrastructureData();
        $updatedInfrastructure = $this->infrastructureRepo->update($fakeInfrastructure, $infrastructure->id);
        $this->assertModelData($fakeInfrastructure, $updatedInfrastructure->toArray());
        $dbInfrastructure = $this->infrastructureRepo->find($infrastructure->id);
        $this->assertModelData($fakeInfrastructure, $dbInfrastructure->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInfrastructure()
    {
        $infrastructure = $this->makeInfrastructure();
        $resp = $this->infrastructureRepo->delete($infrastructure->id);
        $this->assertTrue($resp);
        $this->assertNull(Infrastructure::find($infrastructure->id), 'Infrastructure should not exist in DB');
    }
}

<?php

use App\Models\Tt;
use App\Repositories\TtRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TtRepositoryTest extends TestCase
{
    use MakeTtTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TtRepository
     */
    protected $ttRepo;

    public function setUp()
    {
        parent::setUp();
        $this->ttRepo = App::make(TtRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTt()
    {
        $tt = $this->fakeTtData();
        $createdTt = $this->ttRepo->create($tt);
        $createdTt = $createdTt->toArray();
        $this->assertArrayHasKey('id', $createdTt);
        $this->assertNotNull($createdTt['id'], 'Created Tt must have id specified');
        $this->assertNotNull(Tt::find($createdTt['id']), 'Tt with given id must be in DB');
        $this->assertModelData($tt, $createdTt);
    }

    /**
     * @test read
     */
    public function testReadTt()
    {
        $tt = $this->makeTt();
        $dbTt = $this->ttRepo->find($tt->id);
        $dbTt = $dbTt->toArray();
        $this->assertModelData($tt->toArray(), $dbTt);
    }

    /**
     * @test update
     */
    public function testUpdateTt()
    {
        $tt = $this->makeTt();
        $fakeTt = $this->fakeTtData();
        $updatedTt = $this->ttRepo->update($fakeTt, $tt->id);
        $this->assertModelData($fakeTt, $updatedTt->toArray());
        $dbTt = $this->ttRepo->find($tt->id);
        $this->assertModelData($fakeTt, $dbTt->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTt()
    {
        $tt = $this->makeTt();
        $resp = $this->ttRepo->delete($tt->id);
        $this->assertTrue($resp);
        $this->assertNull(Tt::find($tt->id), 'Tt should not exist in DB');
    }
}

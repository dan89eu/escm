<?php

use App\Models\Vertical;
use App\Repositories\VerticalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VerticalRepositoryTest extends TestCase
{
    use MakeVerticalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var VerticalRepository
     */
    protected $verticalRepo;

    public function setUp()
    {
        parent::setUp();
        $this->verticalRepo = App::make(VerticalRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateVertical()
    {
        $vertical = $this->fakeVerticalData();
        $createdVertical = $this->verticalRepo->create($vertical);
        $createdVertical = $createdVertical->toArray();
        $this->assertArrayHasKey('id', $createdVertical);
        $this->assertNotNull($createdVertical['id'], 'Created Vertical must have id specified');
        $this->assertNotNull(Vertical::find($createdVertical['id']), 'Vertical with given id must be in DB');
        $this->assertModelData($vertical, $createdVertical);
    }

    /**
     * @test read
     */
    public function testReadVertical()
    {
        $vertical = $this->makeVertical();
        $dbVertical = $this->verticalRepo->find($vertical->id);
        $dbVertical = $dbVertical->toArray();
        $this->assertModelData($vertical->toArray(), $dbVertical);
    }

    /**
     * @test update
     */
    public function testUpdateVertical()
    {
        $vertical = $this->makeVertical();
        $fakeVertical = $this->fakeVerticalData();
        $updatedVertical = $this->verticalRepo->update($fakeVertical, $vertical->id);
        $this->assertModelData($fakeVertical, $updatedVertical->toArray());
        $dbVertical = $this->verticalRepo->find($vertical->id);
        $this->assertModelData($fakeVertical, $dbVertical->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteVertical()
    {
        $vertical = $this->makeVertical();
        $resp = $this->verticalRepo->delete($vertical->id);
        $this->assertTrue($resp);
        $this->assertNull(Vertical::find($vertical->id), 'Vertical should not exist in DB');
    }
}

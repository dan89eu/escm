<?php

use App\Models\Beneficiary;
use App\Repositories\BeneficiaryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeneficiaryRepositoryTest extends TestCase
{
    use MakeBeneficiaryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BeneficiaryRepository
     */
    protected $beneficiaryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->beneficiaryRepo = App::make(BeneficiaryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBeneficiary()
    {
        $beneficiary = $this->fakeBeneficiaryData();
        $createdBeneficiary = $this->beneficiaryRepo->create($beneficiary);
        $createdBeneficiary = $createdBeneficiary->toArray();
        $this->assertArrayHasKey('id', $createdBeneficiary);
        $this->assertNotNull($createdBeneficiary['id'], 'Created Beneficiary must have id specified');
        $this->assertNotNull(Beneficiary::find($createdBeneficiary['id']), 'Beneficiary with given id must be in DB');
        $this->assertModelData($beneficiary, $createdBeneficiary);
    }

    /**
     * @test read
     */
    public function testReadBeneficiary()
    {
        $beneficiary = $this->makeBeneficiary();
        $dbBeneficiary = $this->beneficiaryRepo->find($beneficiary->id);
        $dbBeneficiary = $dbBeneficiary->toArray();
        $this->assertModelData($beneficiary->toArray(), $dbBeneficiary);
    }

    /**
     * @test update
     */
    public function testUpdateBeneficiary()
    {
        $beneficiary = $this->makeBeneficiary();
        $fakeBeneficiary = $this->fakeBeneficiaryData();
        $updatedBeneficiary = $this->beneficiaryRepo->update($fakeBeneficiary, $beneficiary->id);
        $this->assertModelData($fakeBeneficiary, $updatedBeneficiary->toArray());
        $dbBeneficiary = $this->beneficiaryRepo->find($beneficiary->id);
        $this->assertModelData($fakeBeneficiary, $dbBeneficiary->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBeneficiary()
    {
        $beneficiary = $this->makeBeneficiary();
        $resp = $this->beneficiaryRepo->delete($beneficiary->id);
        $this->assertTrue($resp);
        $this->assertNull(Beneficiary::find($beneficiary->id), 'Beneficiary should not exist in DB');
    }
}

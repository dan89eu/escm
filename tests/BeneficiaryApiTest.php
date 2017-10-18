<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeneficiaryApiTest extends TestCase
{
    use MakeBeneficiaryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBeneficiary()
    {
        $beneficiary = $this->fakeBeneficiaryData();
        $this->json('POST', '/api/v1/beneficiaries', $beneficiary);

        $this->assertApiResponse($beneficiary);
    }

    /**
     * @test
     */
    public function testReadBeneficiary()
    {
        $beneficiary = $this->makeBeneficiary();
        $this->json('GET', '/api/v1/beneficiaries/'.$beneficiary->id);

        $this->assertApiResponse($beneficiary->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBeneficiary()
    {
        $beneficiary = $this->makeBeneficiary();
        $editedBeneficiary = $this->fakeBeneficiaryData();

        $this->json('PUT', '/api/v1/beneficiaries/'.$beneficiary->id, $editedBeneficiary);

        $this->assertApiResponse($editedBeneficiary);
    }

    /**
     * @test
     */
    public function testDeleteBeneficiary()
    {
        $beneficiary = $this->makeBeneficiary();
        $this->json('DELETE', '/api/v1/beneficiaries/'.$beneficiary->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/beneficiaries/'.$beneficiary->id);

        $this->assertResponseStatus(404);
    }
}

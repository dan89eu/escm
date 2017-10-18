<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InfrastructureApiTest extends TestCase
{
    use MakeInfrastructureTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInfrastructure()
    {
        $infrastructure = $this->fakeInfrastructureData();
        $this->json('POST', '/api/v1/infrastructures', $infrastructure);

        $this->assertApiResponse($infrastructure);
    }

    /**
     * @test
     */
    public function testReadInfrastructure()
    {
        $infrastructure = $this->makeInfrastructure();
        $this->json('GET', '/api/v1/infrastructures/'.$infrastructure->id);

        $this->assertApiResponse($infrastructure->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInfrastructure()
    {
        $infrastructure = $this->makeInfrastructure();
        $editedInfrastructure = $this->fakeInfrastructureData();

        $this->json('PUT', '/api/v1/infrastructures/'.$infrastructure->id, $editedInfrastructure);

        $this->assertApiResponse($editedInfrastructure);
    }

    /**
     * @test
     */
    public function testDeleteInfrastructure()
    {
        $infrastructure = $this->makeInfrastructure();
        $this->json('DELETE', '/api/v1/infrastructures/'.$infrastructure->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/infrastructures/'.$infrastructure->id);

        $this->assertResponseStatus(404);
    }
}

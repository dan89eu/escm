<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConectivityApiTest extends TestCase
{
    use MakeConectivityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateConectivity()
    {
        $conectivity = $this->fakeConectivityData();
        $this->json('POST', '/api/v1/conectivities', $conectivity);

        $this->assertApiResponse($conectivity);
    }

    /**
     * @test
     */
    public function testReadConectivity()
    {
        $conectivity = $this->makeConectivity();
        $this->json('GET', '/api/v1/conectivities/'.$conectivity->id);

        $this->assertApiResponse($conectivity->toArray());
    }

    /**
     * @test
     */
    public function testUpdateConectivity()
    {
        $conectivity = $this->makeConectivity();
        $editedConectivity = $this->fakeConectivityData();

        $this->json('PUT', '/api/v1/conectivities/'.$conectivity->id, $editedConectivity);

        $this->assertApiResponse($editedConectivity);
    }

    /**
     * @test
     */
    public function testDeleteConectivity()
    {
        $conectivity = $this->makeConectivity();
        $this->json('DELETE', '/api/v1/conectivities/'.$conectivity->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/conectivities/'.$conectivity->id);

        $this->assertResponseStatus(404);
    }
}

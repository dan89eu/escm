<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VerticalApiTest extends TestCase
{
    use MakeVerticalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateVertical()
    {
        $vertical = $this->fakeVerticalData();
        $this->json('POST', '/api/v1/verticals', $vertical);

        $this->assertApiResponse($vertical);
    }

    /**
     * @test
     */
    public function testReadVertical()
    {
        $vertical = $this->makeVertical();
        $this->json('GET', '/api/v1/verticals/'.$vertical->id);

        $this->assertApiResponse($vertical->toArray());
    }

    /**
     * @test
     */
    public function testUpdateVertical()
    {
        $vertical = $this->makeVertical();
        $editedVertical = $this->fakeVerticalData();

        $this->json('PUT', '/api/v1/verticals/'.$vertical->id, $editedVertical);

        $this->assertApiResponse($editedVertical);
    }

    /**
     * @test
     */
    public function testDeleteVertical()
    {
        $vertical = $this->makeVertical();
        $this->json('DELETE', '/api/v1/verticals/'.$vertical->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/verticals/'.$vertical->id);

        $this->assertResponseStatus(404);
    }
}

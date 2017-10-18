<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TtApiTest extends TestCase
{
    use MakeTtTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTt()
    {
        $tt = $this->fakeTtData();
        $this->json('POST', '/api/v1/tts', $tt);

        $this->assertApiResponse($tt);
    }

    /**
     * @test
     */
    public function testReadTt()
    {
        $tt = $this->makeTt();
        $this->json('GET', '/api/v1/tts/'.$tt->id);

        $this->assertApiResponse($tt->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTt()
    {
        $tt = $this->makeTt();
        $editedTt = $this->fakeTtData();

        $this->json('PUT', '/api/v1/tts/'.$tt->id, $editedTt);

        $this->assertApiResponse($editedTt);
    }

    /**
     * @test
     */
    public function testDeleteTt()
    {
        $tt = $this->makeTt();
        $this->json('DELETE', '/api/v1/tts/'.$tt->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tts/'.$tt->id);

        $this->assertResponseStatus(404);
    }
}

<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SessionTest extends TestCase
{
    public function testShouldBeWarningFieldAccessIp()
    {
        $this->json('POST','/token', [
            
        ], [
            'Content-Type' => 'application/json'
        ]);

        $this->assertEquals(json_encode([
            'response' => [
                'action' => 1,
                'msg' => 'O campo accessIp é obrigatório',
                'internal' => 'Erro de regra'
            ],
            'data' => null,
        ]), $this->response->getContent());
    }

    public function testShouldBeWarningFieldAccessBrowser()
    {
        $this->json('POST','/token', [
            'accessIp' => '123'
        ], [
            'Content-Type' => 'application/json'
        ]);

        $this->assertEquals(json_encode([
            'response' => [
                'action' => 1,
                'msg' => 'O campo accessBrowser é obrigatório',
                'internal' => 'Erro de regra'
            ],
            'data' => null,
        ]), $this->response->getContent());
    }
}

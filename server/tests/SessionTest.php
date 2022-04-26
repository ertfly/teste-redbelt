<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SessionTest extends TestCase
{
    public function testShouldBeWarningFieldAccessIp()
    {
        $this->post('/token', [
            'accessIp' => '123.123.123.123',
            'accessBrowser' => 'Safari'
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
}

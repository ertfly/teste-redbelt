<?php

namespace Tests;

class MiddlewareTest extends TestCase
{
    public function testShouldBeRouteNotFound()
    {
        $this->get('/route-not-found-test');

        $data = $this->response->getContent();

        $this->assertEquals(json_encode([
            'response' => [
                'action' => 1,
                'msg' => 'Ocorreu um erro, favor tentar novamente mais tarde.',
                'internal' => 'Rota inválida'
            ],
            'data' => null,
        ]), $this->response->getContent());
    }

    public function testShouldBeMethodNotAllowed()
    {
        $this->get('/token');

        $data = $this->response->getContent();

        $this->assertEquals(json_encode([
            'response' => [
                'action' => 1,
                'msg' => 'Ocorreu um erro, favor tentar novamente mais tarde.',
                'internal' => 'Método do endpoint não permitido'
            ],
            'data' => null,
        ]), $this->response->getContent());
    }
}

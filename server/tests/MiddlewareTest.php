<?php

namespace Tests;

class SessionTest extends TestCase
{
    public function testShouldBeRouteNotFound()
    {
        $this->get('/route-not-found-test',['token'=>'123']);

        $data = $this->response->getContent();

        $this->assertEquals(json_encode([
            'response'=>[
                'action' => 1,
                'msg' => 'Ocorreu um erro, favor tentar novamente mais tarde.',
                'internal' => 'Rota inválida'
            ],
            'data' => null,
        ]), $this->response->getContent());
    }
}

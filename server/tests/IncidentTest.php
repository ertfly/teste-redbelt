<?php

namespace Tests;

class IncidentTest extends TestCase
{
    public function testShouldBeListCriticals()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);
        $this->json('POST', '/account/login', [
            'username' => 'admin',
            'pass' => 'admin'
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ]);

        $this->json('GET', '/incident', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }

    
}

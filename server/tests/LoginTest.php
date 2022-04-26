<?php

namespace Tests;

class LoginTest extends TestCase
{
    public function testShouldBeLoginValid()
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
        ])->seeJson([
            'action' => 0,
        ]);
    }

    public function testShouldBeLoginNotValid()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);
        $this->json('POST', '/account/login', [
            'username' => 'admin',
            'pass' => 'admin2'
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 1,
        ]);
    }
}

<?php

namespace Tests;

class SessionTest extends TestCase
{
    public function testShouldBeCreateToken()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ])->seeJson([
            'action' => 0,
            'logged' => 0,
        ]);
    }

    public function testShouldBeTokenValid()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);
        $this->json('GET', '/token', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }
}

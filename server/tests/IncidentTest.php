<?php

namespace Tests;

class IncidentTest extends TestCase
{
    public function testShouldBeNotListCriticalsWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);

        $this->json('GET', '/incident', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

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

    public function testShouldBeNotCreateDataWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);

        $this->json('GET', '/incident/create', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

    public function testShouldBeCreateData()
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

        $this->json('GET', '/incident/create', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }

    public function testShouldBeNotCreateIncidentWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);

        $this->json('POST', '/incident', [
            'title' => 'TestCase',
            'description' => 'Descrição TestCase',
            'criticalId' => 1,
            'typeId' => 1,
            'statusId' => 1,
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

    public function testShouldBeCreateIncident()
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

        $this->json('POST', '/incident', [
            'title' => 'TestCase',
            'description' => 'Descrição TestCase',
            'criticalId' => 1,
            'typeId' => 1,
            'statusId' => 1,
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }

    public function testShouldBeNotUpdateIncidentWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);

        $this->json('PUT', '/incident/1', [
            'title' => 'TestCase',
            'description' => 'Descrição TestCase',
            'criticalId' => 1,
            'typeId' => 1,
            'statusId' => 1,
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

    public function testShouldBeUpdateIncident()
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

        $this->json('PUT', '/incident/1', [
            'title' => 'TestCase',
            'description' => 'Descrição TestCase',
            'criticalId' => 1,
            'typeId' => 1,
            'statusId' => 1,
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }


}

<?php

namespace Tests;

use App\Libraries\Number;
use App\Libraries\Strings;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class UserTest extends TestCase
{
    public function testShouldBeNotListUserWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);
        $this->json('GET', '/user', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

    public function testShouldBeListUsers()
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

        $this->json('GET', '/user', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }

    public function testShouldBeNotCreateUserWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);

        $this->json('POST', '/user', [
            'name' => 'Usuário Teste',
            'username' => Number::key(7),
            'pass' => '123',
            'passConfirm' => '123'
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

    public function testShouldBeCreateUser()
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

        $this->json('POST', '/user', [
            'name' => 'Usuário Teste',
            'username' => Number::key(7),
            'pass' => '123',
            'passConfirm' => '123'
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }

    public function testShouldBeNotUpdateUserWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);

        $this->json('PUT', '/user/1', [
            'name' => 'Administrador',
            'username' => 'admin',
            'pass' => 'admin',
            'passConfirm' => 'admin'
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

    public function testShouldBeNotUpdateUserWhyRecordNotFound()
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

        $this->json('PUT', '/user/0', [
            'name' => 'Administrador',
            'username' => 'admin',
            'pass' => 'admin',
            'passConfirm' => 'admin'
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 1,
        ]);
    }

    public function testShouldBeUpdateUser()
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

        $this->json('PUT', '/user/1', [
            'name' => 'Administrador',
            'username' => 'admin',
            'pass' => 'admin',
            'passConfirm' => 'admin'
        ], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }

    public function testShouldBeNotShowDataUserWhyNotLogin()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ]);
        $responseToken = json_decode($this->response->getContent(), true);

        $this->json('GET', '/user/1', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 3,
        ]);
    }

    public function testShouldBeShowDataUser()
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

        $this->json('GET', '/user/1', [], [
            'Content-Type' => 'application/json',
            'token' => $responseToken['data']['token'],
        ])->seeJson([
            'action' => 0,
        ]);
    }
}

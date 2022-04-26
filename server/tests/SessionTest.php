<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SessionTest extends TestCase
{
    public function testShouldBeCreateToken()
    {
        $this->json('POST', '/token', [], [
            'Content-Type' => 'application/json'
        ])->seeJson([
            'action' => 0,
        ]);
    }
}

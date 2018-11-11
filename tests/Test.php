
<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }

    public function testUser()
    {
        $response = $this->client->get('/users/1');
       $body = $response->getBody()->getContents();
       $this->assertNotEmpty($body);
    }

    public function testUser2()
    {
        $response = $this->client->get('/users/99');
        $body = $response->getBody()->getContents();
        $this->assertContains('Horace', $body);
        $this->assertContains('Feest', $body);
        $this->assertContains('harmstrong@lakin.com', $body);
    }

    public function testUser3()
    {
        $response = $this->client->get('/users/100');
        $body = $response->getBody()->getContents();

        $this->assertContains('Euna', $body);
        $this->assertContains('Veum', $body);
    }

    public function testUsers()
    {
        $response = $this->client->get('/users');
        $body = $response->getBody()->getContents();

        $this->assertContains('Adah', $body);
        $this->assertContains('Trinity', $body);
    }

    public function testUsers2()
    {
        $response = $this->client->get('/users?page=2');
        $body = $response->getBody()->getContents();

        $this->assertContains('Cleve', $body);
        $this->assertContains('Karlie', $body);
    }
}


<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiTest
 * @package App\Tests\Functional
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
class ApiTest extends WebTestCase
{
    /**
     * Api available test.
     */
    public function testApiShouldReturnOkHttpResponse()
    {
        $client = self::createClient();
        $client->request('GET', '/api/');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Api should return json response.
     */
    public function testApiShouldReturnJsonResponse()
    {
        $client = self::createClient();
        $client->request('GET', '/api/');

        $resp = $client->getResponse();

        $this->assertResponseIsSuccessful($resp);
        $this->assertJson($resp->getContent());
        $this->assertArrayHasKey('message', json_decode($resp->getContent(), true));
    }
}

<?php

namespace App\Tests\Functional;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiTest
 * @package App\Tests\Functional
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
class ProductApiTest extends WebTestCase
{
    /**
     * @dataProvider productDataProvider
     * @param array $productData
     */
    public function testApiShouldValidateQueryString(array $productData)
    {
        $client = self::createClient();

        $client->request('GET', "/api/v1/product{$productData['query_string']}");

        $errors = json_decode($client->getResponse()->getContent(), true);

        $this->assertSame(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $client->getResponse()->getStatusCode()
        );

        $this->assertJson($client->getResponse()->getContent());
        $this->assertArrayHasKey($productData['key'], $errors['data']);
    }

    public function productDataProvider(): Generator
    {
        yield [
            [
                'query_string' => '?limit=1',
                'key' => 'limit',
            ]
        ];

        yield [
            [
                'query_string' => '?page=-1',
                'key' => 'page',
            ]
        ];

        yield [
            [
                'query_string' => '?date_from=2021-01',
                'key' => 'dateFrom',
            ]
        ];

        yield [
            [
                'query_string' => '?date_to=2021-01',
                'key' => 'dateTo',
            ]
        ];

        yield [
            [
                'query_string' => '?date_to=2021-01',
                'key' => 'dateTo',
            ]
        ];

        yield [
            [
                'query_string' => '?time_from=20-00',
                'key' => 'timeFrom',
            ]
        ];

        yield [
            [
                'query_string' => '?time_to=21-01',
                'key' => 'timeTo',
            ]
        ];
    }
}

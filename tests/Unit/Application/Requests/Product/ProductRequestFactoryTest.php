<?php

namespace App\Tests\Unit\Application\Requests\Product;

use App\Application\Requests\Product\ProductRequest;
use App\Application\Requests\Product\ProductRequestFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ProductRequestFactoryTest extends TestCase
{
    public function testCanMakeProductRequest(): void
    {
        $request = new Request();
        $factory = new ProductRequestFactory();

        $this->assertInstanceOf(ProductRequest::class, $factory->make($request));
    }
}

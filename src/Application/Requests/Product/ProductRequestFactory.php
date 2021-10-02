<?php

namespace App\Application\Requests\Product;

use App\Application\Requests\RequestFactoryInterface;
use App\Application\Requests\RequestInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductRequestFactory implements RequestFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function make(Request $request): RequestInterface
    {
        return new ProductRequest($request);
    }
}

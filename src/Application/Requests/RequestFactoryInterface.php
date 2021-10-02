<?php

namespace App\Application\Requests;

use Symfony\Component\HttpFoundation\Request;

interface RequestFactoryInterface
{
    /**
     * Make Request object for validation, handling and etc.
     *
     * @param Request $request
     * @return RequestInterface
     */
    public function make(Request $request): RequestInterface;
}

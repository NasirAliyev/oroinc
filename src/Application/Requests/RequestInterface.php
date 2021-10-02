<?php

namespace App\Application\Requests;

interface RequestInterface
{
    /**
     * Getting page param from request.
     *
     * @return int
     */
    public function getPage(): int;

    /**
     * Getting limit param from request.
     *
     * @return int
     */
    public function getLimit(): int;
}

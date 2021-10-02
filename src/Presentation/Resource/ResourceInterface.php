<?php

namespace App\Presentation\Resource;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface ResourceInterface
 * @package App\Resources
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
interface ResourceInterface
{
    /**
     * Get the request as a proper array.
     *
     * @param Request|null $request
     * @return array
     */
    public function toArray(Request $request = null): array;
}

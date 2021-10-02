<?php

namespace App\Presentation\Resource;

use Doctrine\Common\Collections\Collection;

/**
 * Interface ResourceResponseInterface
 * @package App\Resources
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
interface ResourceResponseInterface
{
    /**
     * Get required array from the collection.
     *
     * @param array|Collection|null $collection
     * @return array
     */
    public function responseArray(Collection|array $collection = null): array;
}

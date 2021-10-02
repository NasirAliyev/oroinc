<?php

namespace App\Application\Service\Product;

use App\Application\Requests\Product\ProductRequest;
use App\Domain\Entity\Product\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class ProductService
 * @package App\Presentation\Service
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
class ProductService
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll(ProductRequest $productRequest): Paginator
    {
        return $this->entityManager
            ->getRepository(Product::class)
            ->findByParams($productRequest);
    }
}

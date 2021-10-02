<?php

namespace App\Tests\Unit\Application\Service\Product;

use App\Application\Service\Pagination\CustomPaginator;
use App\Application\Service\Product\ProductService;
use App\Application\Requests\Product\ProductRequest;
use App\Domain\Entity\Product\Product;
use App\Infrastructure\Repository\Product\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Monolog\Test\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ProductServiceTest extends TestCase
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @var EntityManagerInterface
     */
    private mixed $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->productService = new ProductService($this->entityManager);
    }

    public function testGetAllMethodShouldReturnPagination()
    {
        $paginator = $this->createMock(CustomPaginator::class);

        $repo = $this->createMock(ProductRepository::class);
        $repo->expects($this->any())
            ->method('findByParams')
            ->willReturn($paginator);

        $this->entityManager->expects($this->once())
            ->method('getRepository')
            ->with(Product::class)
            ->willReturn($repo);

        $request = new Request();
        $productRequest = new ProductRequest($request);
        $products = $this->productService->getAll($productRequest);

        $this->assertInstanceOf(Paginator::class, $products);
    }
}

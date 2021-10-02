<?php

namespace App\Infrastructure\Repository\Product;

use App\Application\Service\Pagination\CustomPaginator;
use App\Application\Requests\Product\ProductRequest;
use App\Domain\Entity\Product\Product;
use App\Infrastructure\Repository\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param ProductRequest $productRequest
     * @return Paginator
     */
    public function findByParams(ProductRequest $productRequest): Paginator
    {
        $query = $this->createQueryBuilder('p');

        if ($productRequest->getQuery()) {
            $query = $query->andWhere('p.title = :query')
                ->setParameter('query', $productRequest->getQuery());
        }
        if ($productRequest->getRegex()) {
            $query = $query->andWhere('REGEXP(p.title, :regexp) = true')
                ->setParameter('regexp', $productRequest->getRegex());
        }
        if ($productRequest->getDateFrom()) {
            $query = $query->andWhere('CAST(p.createdAt AS DATE) >= :date_from')
                ->setParameter('date_from', $productRequest->getDateFrom());
        }
        if ($productRequest->getDateTo()) {
            $query = $query->andWhere('CAST(p.createdAt AS DATE) <= :date_to')
                ->setParameter('date_to', $productRequest->getDateTo());
        }
        if ($productRequest->getTimeFrom()) {
            $query = $query->andWhere('CAST(p.createdAt AS TIME) >= :time_from')
                ->setParameter('time_from', $productRequest->getTimeFrom());
        }
        if ($productRequest->getTimeTo()) {
            $query = $query->andWhere('CAST(p.createdAt AS TIME) <= :time_to')
                ->setParameter('time_to', $productRequest->getTimeTo());
        }

        $offset = $productRequest->getOffset() * abs($productRequest->getPage() - 1);
        $query = $query->setFirstResult($offset)->setMaxResults($productRequest->getLimit());

        return new CustomPaginator($query, $productRequest);
    }
}

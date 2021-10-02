<?php

namespace App\Application\Service\Pagination;

use App\Application\Requests\RequestInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class CustomPaginator
 * @package App\Application\Service\Pagination
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
class CustomPaginator extends Paginator
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @var int
     */
    private int $total;

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * CustomPaginator constructor.
     *
     * @param Query|QueryBuilder $query
     * @param RequestInterface $request
     * @param bool $fetchJoinCollection
     */
    public function __construct(
        Query|QueryBuilder $query,
        RequestInterface $request,
        bool $fetchJoinCollection = true
    ) {
        parent::__construct($query, $fetchJoinCollection);

        $this->data = $this->getQuery()->getArrayResult();
        $this->request = $request;
        $this->total = $this->count();
    }

    /**
     * @return array
     */
    #[ArrayShape(['data' => "mixed", 'meta' => "array"])]
    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'meta' => $this->getMetaData()
        ];
    }

    /**
     * Get pagination meta data (links, total, per page).
     *
     * @return array
     */
    #[ArrayShape([
        'current_page' => "int",
        'per_page' => "int",
        'next_page' => "string",
        'previous_page' => "int|string",
        'total' => "int|mixed"
    ])]
    private function getMetaData(): array
    {
        $nextPage = $previousPage = null;

        if (($this->request->getPage() * $this->request->getLimit()) < $this->total) {
            $nextPage = '?limit=' . $this->request->getLimit() . '&page=' . $this->request->getPage() + 1;
        }

        if (($this->request->getPage() - 1) > 0) {
            $previousPage .= '?limit=' . $this->request->getLimit() . '&page=' . $this->request->getPage() - 1;
        }

        return [
            'current_page' => $this->request->getPage(),
            'per_page' => $this->request->getPage(),
            'next_page' => $nextPage,
            'previous_page' => $previousPage,
            'total' => $this->total
        ];
    }
}

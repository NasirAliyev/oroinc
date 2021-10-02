<?php

namespace App\Application\Requests\Product;

use App\Application\Requests\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ProductRequest implements RequestInterface
{
    public const DEFAULT_LIMIT = 25;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->limit     = (int) $request->get('limit', self::DEFAULT_LIMIT);
        $this->offset    = (int) $request->get('offset', 0);
        $this->page      = (int) $request->get('page', 1);
        $this->query     = $request->get('query', '');
        $this->regex     = $request->get('regex', '');
        $this->dateFrom  = $request->get('date_from', '');
        $this->dateTo    = $request->get('date_to', '');
        $this->timeFrom  = $request->get('time_from', '');
        $this->timeTo    = $request->get('time_to', '');
    }

    /**
     * @var int
     */
    #[Assert\Type('int')]
    #[Assert\Regex('/10|25|50|100/', 'Limit can be only 10, 25, 50, 100')]
    private int $limit;

    /**
     * @var int
     */
    #[Assert\Type('int')]
    private int $offset;

    /**
     * @var int
     */
    #[Assert\Type('int')]
    #[Assert\Positive]
    private int $page;

    /**
     * @var string
     */
    #[Assert\Type('string')]
    private string $query;

    /**
     * @var string
     */
    #[Assert\Type('string')]
    private string $regex;

    /**
     * @var string
     */
    #[Assert\DateTime('Y-m-d', 'This value is not a valid date. The date format must be "Y-m-d"')]
    private string $dateFrom;

    /**
     * @var string
     */
    #[Assert\DateTime('Y-m-d', 'This value is not a valid date. The date format must be "Y-m-d"')]
    private string $dateTo;

    /**
     * @var string
     */
    #[Assert\DateTime('H:i', 'This value is not a valid time. The time format must be "H:i"')]
    private string $timeFrom;

    /**
     * @var string
     */
    #[Assert\DateTime('H:i', 'This value is not a valid time. The time format must be "H:i"')]
    private string $timeTo;

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getRegex(): string
    {
        return $this->regex;
    }

    /**
     * @return string
     */
    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    /**
     * @return string
     */
    public function getDateTo(): string
    {
        return $this->dateTo;
    }

    /**
     * @return string
     */
    public function getTimeFrom(): string
    {
        return $this->timeFrom;
    }

    /**
     * @return string
     */
    public function getTimeTo(): string
    {
        return $this->timeTo;
    }
}

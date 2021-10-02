<?php

namespace App\Presentation\Resource;

use App\Application\Service\Pagination\CustomPaginator;
use Doctrine\ORM\Tools\Pagination\Paginator;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ResponseResource
 * @package App\Resources
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
class ResponseResource implements ResourceInterface
{
    private array $data;

    private string $msg;

    /**
     * ResponseResource constructor.
     *
     * @param string $msg
     * @param array $data
     */
    public function __construct(string $msg, array $data)
    {
        $this->msg = $msg;
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    #[ArrayShape(['message' => "string", 'data' => "array"])]
    public function toArray(Request $request = null): array
    {
        return [
            'message' => $this->msg,
            'data' => $this->data
        ];
    }
}

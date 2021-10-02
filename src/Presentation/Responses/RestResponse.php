<?php

namespace App\Presentation\Responses;

use App\Presentation\Resource\ResponseResource;
use Doctrine\ORM\Tools\Pagination\Paginator;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Trait RestResponse
 * @package App\Traits
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
trait RestResponse
{
    /**
     * Getting all errors from form validation.
     *
     * @param ConstraintViolationList $errors
     * @return array
     */
    public function getErrorMessages(ConstraintViolationList $errors): array
    {
        $errorsArr = [];

        foreach ($errors as $error) {
            $errorsArr[$error->getPropertyPath()] = $error->getMessage();
        }

        return $errorsArr;
    }

    /**
     * Get structured response object.
     *
     * @param string $msg
     * @param array $data
     * @return ResponseResource
     */
    #[Pure]
    protected function responseFactory(string $msg, array $data): ResponseResource
    {
        return new ResponseResource($msg, $data);
    }

    /**
     * Rest success response.
     *
     * @param string $msg
     * @param array $data
     * @param Paginator|null $paginator
     * @param int $code
     * @return JsonResponse
     */
    public function success(
        string $msg = '',
        array $data = [],
        Paginator $paginator = null,
        int $code = Response::HTTP_OK
    ): JsonResponse {
        if ($paginator) {
            $data = $paginator->toArray();
        }

        return new JsonResponse($this->responseFactory($msg, $data)->toArray(), $code);
    }

    /**x
     * Rest failed response.
     *
     * @param string $msg
     * @param int $code
     * @param ConstraintViolationListInterface|null $violations
     * @param array $data
     * @return JsonResponse
     */
    public function fail(
        string $msg = '',
        int $code = Response::HTTP_BAD_REQUEST,
        array $data = [],
        ConstraintViolationListInterface $violations = null
    ): JsonResponse {
        if ($violations) {
            $data = $this->getErrorMessages($violations);
            $msg = MessagesInterface::VALIDATION_ERROR;
        }

        return new JsonResponse($this->responseFactory($msg, $data)->toArray(), $code);
    }
}

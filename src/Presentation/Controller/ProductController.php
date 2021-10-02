<?php

namespace App\Presentation\Controller;

use App\Application\Service\Product\ProductService;
use App\Application\Requests\RequestFactoryInterface;
use App\Presentation\Responses\RestResponse;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ProductController.
 *
 * @package App\Controller
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
class ProductController extends AbstractController
{
    use RestResponse;

    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    /**
     * ProductController constructor.
     *
     * @param ProductService $productService
     * @param LoggerInterface $logger
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ProductService $productService,
        LoggerInterface $logger,
        ValidatorInterface $validator
    ) {
        $this->productService = $productService;
        $this->logger = $logger;
        $this->validator = $validator;
    }

    /**
     * Get products.
     */
    #[Route(path: '/v1/product', name: 'product_get', methods: ['GET'])]
    public function getProducts(Request $request, RequestFactoryInterface $factory): JsonResponse
    {
        $productRequest = $factory->make($request);
        $errors = $this->validator->validate($productRequest);

        if ($errors->count()) {
            return $this->fail('Input errors', Response::HTTP_UNPROCESSABLE_ENTITY, [], $errors);
        }

        try {
            $products = $this->productService->getAll($productRequest);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            return $this->fail('Server error', Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->success("Success", [], $products);
    }
}

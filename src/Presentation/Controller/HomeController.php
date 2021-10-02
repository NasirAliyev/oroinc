<?php

namespace App\Presentation\Controller;

use App\Presentation\Responses\RestResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Presentation\Controller
 */
class HomeController extends AbstractController
{
    use RestResponse;

    /**
     * @return JsonResponse
     */
    #[Route(path: '/', name: 'home', methods: ['GET'])]
    public function index()
    {
        return $this->success('Rest api', [
            '@author'  => 'Nasir Aliyev',
            '@version' => '1.0',
        ]);
    }
}

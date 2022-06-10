<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AttacheController extends AbstractController
{
    #[Route('/attache', name: 'app_attache')]
    public function index()
    {
        return $this->render('attache/index.html.twig');
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/AttacheController.php',
        // ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AuthentificationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/connexion', name: 'user_login')]
    public function login(){
        return $this->render('user/index.html.twig');
    }

    #[Route('/accueil', name: 'accueil_user')]
    public function accueil(){
        return $this->render('base/index.html.twig');
    }

    #[Route('/deconnexion', name: 'user_logout')]
    public function logout(){
        return $this->render('user/index.html.twig');
    }
}
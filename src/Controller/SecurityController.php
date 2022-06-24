<?php

namespace App\Controller;

use App\Entity\AnneeScolaire;
use App\Repository\AnneeScolaireRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, 
    SessionInterface $session, AnneeScolaireRepository $repAn): Response
    {
        $annee = $repAn->findOneBy(['etat' => 'en cours']);
        $session->set('annee', $annee);

        if ($this->getUser()) {
            return $this->redirectToRoute('target_path');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

     #[Route(path: '/user', name: 'app_user')]
     public function user(UserRepository $rep): Response
     {
         return $this->render('security/login.html.twig', [
        'users'=> $rep->findAll(),
        ]);
     }
}





// namespace App\Controller;

// use App\Entity\AnneeScolaire;
// use App\Repository\AnneeScolaireRepository;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

// class SecurityController extends AbstractController
// {
//     #[Route(path: '/login', name: 'app_login')]
//     public function login(AuthenticationUtils $authenticationUtils,
//     AnneeScolaireRepository $rep, SessionInterface $session): Response
//     {
//         if ($this->getUser()) {
//             $an = $rep->findAll();
//             $session->set("annees", $an);
//             return $this->redirectToRoute('target_path');
//         }

//         // get the login error if there is one
//         $error = $authenticationUtils->getLastAuthenticationError();
//         // last username entered by the user
//         $lastUsername = $authenticationUtils->getLastUsername();

//         return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
//     }

//     #[Route(path: '/logout', name: 'app_logout')]
//     public function logout(): void
//     {
//         throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
//     }
// }

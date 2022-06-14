<?php

namespace App\Controller;

use Psr\Log\NullLogger;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'etudiant_inscription')]
    #[Route('/reinscription', name: 'etudiant_reinscription')]
    public function inscription(Inscription $inscription=null,
    Request $request, ManagerRegistry $doctrine): Response
    {

        $manager = $doctrine->getManager();

        if(!$inscription){
            $inscription = new Inscription();
        }

        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($inscription);


            $manager->flush();
        }

        return $this->render('inscription/index.html.twig', [
            'reinscri' => $inscription,
            'form' => $form->createView()
         ]);      
    }
}

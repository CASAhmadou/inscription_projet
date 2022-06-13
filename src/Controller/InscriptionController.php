<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\InscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'etudiant_inscription')]
    public function index(
    Request $request, ManagerRegistry $doctrine): Response
    {
        $inscription = new Inscription();
        $manager = $doctrine->getManager();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView()
        ]);      
    }
}

<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    
    #[Route('/etudiant', name: 'etudiant')]
    public function createEtudiant(
    Request $request, ManagerRegistry $doctrine): Response
    {
        $etudiant = new Etudiant();
        $manager = $doctrine->getManager();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        return $this->render('etudiant/index.html.twig', [
            'formEtudiant' => $form->createView()
        ]);      
    }
}


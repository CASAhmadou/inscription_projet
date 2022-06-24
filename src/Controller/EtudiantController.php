<?php

namespace App\Controller;

use DateTime;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
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


        // $password = 'cas@123';
        // for ($i = 1; $i <=10; $i++) {
        //     $etudiant->setEmail('et'.$i."@gmail.com");
        //     $etudiant->setMatricule('SN00'.$i);  
        //     $encoded = $this->encoder->hashPassword($etudiant, $password);
        //     $etudiant->setPassword($encoded);
        //  $user->setRoles(['Role_Etudiant']);
            
        //  $this->addReference("User".$i, $user);
       // }

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($etudiant);

            $inscri= new Inscription();
            $inscri->setEtudiant($etudiant);
           // $inscri->setAnneeScolaire(new \DateTime('now'));
           //$manager->persist($inscri);

            $manager->flush();
        }

        return $this->render('etudiant/index.html.twig', [
            'formEtudiant' => $form->createView()
        ]);      
    }
}


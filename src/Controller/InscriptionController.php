<?php

namespace App\Controller;

use App\Entity\User;
use Psr\Log\NullLogger;
use SessionIdInterface;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use App\Form\InscriptionType;
use App\Repository\EtudiantRepository;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AnneeScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/listeinscrit', name: 'inscription')]
    public function index(InscriptionRepository $repIns, 
    SessionInterface $session, PaginatorInterface $paginator, 
    Request $request): Response
    {
        $data = $repIns->findBy(array(), array('id' => 'DESC'));
        $inscription = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('inscription/inscription.html.twig', [
            'controller_name' => 'ClasseController',
            'inscriptions' => $inscription,
        ]);
    }

    #[Route('/inscription', name: 'etudiant_inscription')]
    #[Route('/reinscription', name: 'etudiant_reinscription')]
    public function inscription(Inscription $inscription=null,
    Request $request, ManagerRegistry $doctrine, InscriptionRepository $repIns, AnneeScolaireRepository $repAn,
    Etudiant $etudiant = null, UserPasswordHasherInterface $encoder, 
    EtudiantRepository $repEt, SessionIdInterface $session ): Response
    {
        $manager = $doctrine->getManager();

        if(!$inscription){
            $inscription = new Inscription();
        }

        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = new User();
            $etudiant = new Etudiant();

            $email = $form->$inscription->getEtudiant()->getNomComplet();
            $email = str_replace(' ', '', $email);
            $nId = $repEt->findBy(array(), array('id' => 'desc'),1,0);
            $nId = $nId[0]->getId();
            $email = $email.$nId;

            $password = 'cas@123';
            $hashedPassword = $encoder->hashPassword($user, $password);
	
            $user = $this->getUser();
           // $date = $session->get('annee')[0];
          //  $date = $date->getId();
           // $date = $repAn->find($date);
            $inscription->getEtudiant()->setMatricule($repIns->genererMatricule());
            $inscription->getEtudiant()->setEmail($email.'@gmail.com');
            $inscription->getEtudiant()->setPassword($hashedPassword);
            $inscription->getEtudiant()->setRoles(["ROLE_ETUDIANT"]);
            $inscription->setAttache($user);
           // $inscription->setAnneeScolaire($date);

        
            $manager->persist($inscription->getEtudiant());
            $manager->flush();

            $inscription->setEtat('en cours');

            $manager->persist($inscription);
            $manager->flush();
            $this->addFlash('success', 'Inscription effectuée avec succès');

            return $this->redirectToRoute('etudiant_inscription');

        }

        return $this->render('inscription/index.html.twig', [
            'reinscri' => $inscription,
            'form' => $form->createView(),
            'modifie' => $inscription->getId() != null,
            'matricule'=>''

         ]);      
    }


    // #[Route('/inscription/reinsc/{id}', name: 'app_create_reinscription')]
    // public function reinscription(Etudiant $etudiant = null,Inscription $insc = null ,Request $request, EntityManagerInterface $manager, InscriptionRepository $repo,SessionInterface $session){
    //     $insc->setId(null);
    //     $reIns = new Inscription;
    //     $reIns->setEtudiant($insc->getEtudiant())
    //     ->setClasse($insc->getClasse())
    //     ->setAc($insc->getAc()); 
    //     $form = $this->createForm(InscriptionType::class,$reIns);
    //     $form->handleRequest($request);      
    //     $reIns->setEtat('en cours');
    
    //     if($form->isSubmitted() && $form->isValid()){
    //         $repo->add($reIns,true);
    //         $this->addFlash('success','la reinscription a bien été  enregistré ');
    //         return $this->redirectToRoute('app_inscription');
    //     }
    //     $editMode = $insc->getId();
    //    // dd($reIns->getEtudiant()->getMatricule());
    //     return $this->render('inscription/create.html.twig', [
    //         'formInscription' => $form->createView(),
    //         'editMode' => $editMode == null,
    //         'matricule'=>$reIns->getEtudiant()->getMatricule(),
    //     ]);

    // }

}

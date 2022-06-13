<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController{
    #[Route('/classe', name: 'classe')]
    public function index(
        ClasseRepository $rep, SessionInterface $session,
        PaginatorInterface $paginator, Request $request
        ): Response
    {
        $cl=$rep->findAll();
        $pagis = $paginator->paginate(
            $cl,
            $request->query->getInt('page',1),
            8
        );
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes'=>$cl,
            'classes'=>$pagis
        ]);
    }

    #[Route('/classe/add', name: 'add_classe')]
    #[Route('/classe/{id}/edit', name: 'edit_classe')]
    public function formClasse(Classe $classe=null,Request $request, ManagerRegistry $doctrine): Response
    {
        $manager = $doctrine->getManager();
      
        // dd($cl);
        if(!$classe){
             $classe= new Classe();
        }

        // $classe->setLibelle('champ de libellé')
        //         ->setFilliere('champ de fillière');

        $form = $this->createForm(ClasseType::class, $classe);   
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->getData());
            $manager->persist($classe); 
            $manager->flush();

            // return $this->redirectToRoute('classe', ['id' =>
            //     $classe->getId]);
        }

        return $this->render('classe/add.html.twig', [          
            'formClasse' => $form->createView(),
            'editClasse' => $classe->getId() != null
        ]);   
    }

    // #[Route('/classe/{id}', name: 'detail_classe')]
    // public function detail(Classe $classe, ClasseRepository $rep, SessionInterface $session)
    // {
    //     $rep->findAll();
    //     return $this->render('classe/detail.html.twig');
    // }
}
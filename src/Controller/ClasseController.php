<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('liste-classe', name: 'liste_classe')]
    public function index(ClasseRepository $rep, SessionInterface $session): Response
    {
        $cl=$rep->findAll();
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes'=>$cl
        ]);
    }

    #[Route('add-classe', name: 'add_classe')]
    public function addClasse()
    {
            return $this->render(view:"classe/add.html.twig");   
    }
    //     if($this->request->isPost()){
    //         extract($_POST);
    //         $cl= new Classe();
    //         $cl->setLibelle($libelle);
    //         $cl->setNiveau($niveau);
    //         $cl->setFilliere($filliere);
    //        // $cl->insert();
    //         $this->render("classe/liste.html.php");
            
    //     }
    

    // #[Route('/add', name: 'app_classe')]
    // public function index(ClasseRepository $rep, SessionInterface $session): Response
    // {
    //     $cl=$rep->findAll();
    //     return $this->render('classe/index.html.twig', [
    //         'controller_name' => 'ClasseController',
    //         'classes'=>$cl
    //     ]);
    // }
}

<?php
namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'professeur')]
    public function index(ProfesseurRepository $repo,
        PaginatorInterface $paginator,Request $request): Response
    {
        $profs=$repo->findAll();
        $pagis = $paginator->paginate(
            $profs,
            $request->query->getInt('page',1),
            5
        );
        
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            'profs' => $profs,
            'profs' => $pagis
        ]);
    }

    #[Route('/professeur/add', name: 'add_professeur')]
    public function formProfesseur(Request $request, ManagerRegistry $doctrine): Response
    {
        $manager = $doctrine->getManager();
        $maitre= new Professeur();
      
        $form = $this->createForm(ProfesseurType::class, $maitre);   
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($maitre); 
            $manager->flush();
        }
            return $this->render('professeur/add.html.twig', [
                'formProfesseur' => $form->createView(),
            ]);
        
    }
}

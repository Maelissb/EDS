<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\Header;
use App\Entity\Presentation;
use App\Entity\Service;
use App\Entity\Team;
use App\Entity\Brand;
use App\Entity\Depannage;
use App\Entity\Label;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface; // Importez la classe EntityManagerInterface


/******************HomePage************************ */
class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/", name: "home")]
    public function index(Request $request): Response
    {
        // Récupérer les données de l'en-tête depuis la base de données
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        // Récupérer les données de la présentation depuis la base de données
        $presentation = $this->entityManager->getRepository(Presentation::class)->findAll();

         // Récupérer les données de la présentation depuis la base de données
        $entreprise = $this->entityManager->getRepository(Entreprise::class)->findBy(['id' => 1]);

        
        return $this->render('home/index.html.twig', [
            'headers' => $headers,
            'presentation' => $presentation,
            'entreprise' => $entreprise,
        ]);
    }
/******************Page entreprise************************ */
    #[Route("/entreprise", name: "entreprise")]
    public function indexEntreprise(Request $request): Response
    {   $service = $this->entityManager->getRepository(Service::class)->findAll();

        $entreprise = $this->entityManager->getRepository(Entreprise::class)->findBy(['id' => 2]);

        $team = $this->entityManager->getRepository(Team::class)->findAll();

        $brand = $this->entityManager->getRepository(Brand::class)->findAll();


        return $this->render('front/entreprise.html.twig',[
            'service' =>$service,
            'entreprise' => $entreprise,
            'team' => $team,
            'brand' => $brand,
        ]);
    }
    /******************Page depannage/plomberie************************ */
    #[Route("/plomberie", name: "depannage_plomberie")]
    public function indexplomberie(Request $request): Response
    {   
        $depannage = $this->entityManager->getRepository(Depannage::class)->findBy(['id' => 1]);
        $label = $this->entityManager->getRepository(Label::class)->findBy(['id' => 1]);
    
        return $this->render('front/plomberie.html.twig', [
            'depannage' => $depannage,
            'label' => $label,
            
        ]);  
    
}

  /******************Page depannage/plomberie************************ */
  #[Route("/entretien/chauffage", name: "entretien")]
  public function indexentretien(Request $request): Response
  {   
      
      return $this->render('front/entretien/chauffage.html.twig');  
  
}

}
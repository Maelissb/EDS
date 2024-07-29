<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntretienAdminController extends AbstractController{
    #[Route('/admin/Entretien/pompeChaleur{id?}', name: 'app_admin_entretien_pompeChaleur')]
    public function index(): Response
    {
        return $this->render('Admin/admin_entretien/pompeChaleur.html.twig');
    }
    

   #[Route('/admin/Entretien/chauffage{id?}', name: 'app_admin_entretien_chauffage')]
   public function indexChauffage():Response
   {
    return $this->render('Admin/admin_entretien/chauffage.html.twig');
   }

   #[Route('/admin/Entretien/okofen{id?}', name: 'app_admin_entretien_okofen')]
   public function indexOkofen():Response
   {
    return $this->render('Admin/admin_entretien/okofen.html.twig');
   }
}
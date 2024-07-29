<?php

namespace App\Controller\Admin;

use App\Form\ContactType;
use App\Entity\Contact;
use App\Entity\Brand;
use App\Form\BrandType;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Entity\Header;
use App\Entity\Presentation;
use App\Entity\Entreprise;
use App\Entity\Team;
use App\Entity\Footer;
use App\Form\FooterType;
use App\Form\TeamType;
use App\Form\EntrepriseType;
use App\Form\HeaderType;
use App\Form\PresentationGeneralType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\FileException;

class AdmiController extends AbstractController
{   
    #[Route('/admin', name: 'index')]
    public function indexMain(): Response
    {
        return $this->render('admin/index.html.twig');
    }
    // ROUTE POUR LA HOMEPAGE
    #[Route('/admin/home{id?}', name: 'app_admin_home')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
      $header = $entityManager->getRepository(Header::class)->findBy(['id' => 1])[0];
      $headerForm = $this->createForm(HeaderType::class, $header);
      
      $headerForm->handleRequest($request);
      
      if ($headerForm->isSubmitted() && $headerForm->isValid()) {
         
         /** @var UploadedFile $imgFile */
         // Récupérez le fichier téléchargé
          $file = $headerForm->get('headBand')->getData();

          // Générez un nom de fichier unique
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

    // Déplacez le fichier téléchargé dans le répertoire approprié
        $file->move(
        $this->getParameter('upload_directory'), // Chemin vers le répertoire de stockage
        $fileName // Nom de fichier unique
    );
      
          // Persistez les changements dans la base de données
          $entityManager->persist($header);
          $entityManager->flush();
      }
      
      
// *******************************************************
        $presentation = $entityManager->getRepository(presentation::class)->findBy(['id'=>1])[0];
        $presentationForm = $this->createForm(PresentationGeneralType::class, $presentation);

        $presentationForm->handleRequest($request);

       if ($presentationForm->isSubmitted() && $presentationForm->isValid()){

    //       /** @var UploadedFile $imgFile */
    //      // Récupérez le fichier téléchargé
    //       $file = $headerForm->get('headBand')->getData();

    //       // Générez un nom de fichier unique
    //     $fileName = md5(uniqid()) . '.' . $file->guessExtension();

    // // Déplacez le fichier téléchargé dans le répertoire approprié
    //     $file->move(
    //     $this->getParameter('upload_directory'), // Chemin vers le répertoire de stockage
    //     $fileName // Nom de fichier unique
    // );

        $entityManager->persist($presentation);
        $entityManager->flush();

       }
// *******************************************************

       $entreprise = $entityManager->getRepository(Entreprise::class)->findBy(['id'=>1])[0];
       $entrepriseForm = $this->createForm(EntrepriseType::class, $entreprise);

       $entrepriseForm->handleRequest($request);

      if ($entrepriseForm->isSubmitted() && $entrepriseForm->isValid()){

        $entityManager->persist($entreprise);
        $entityManager->flush();
       }

       return $this->render('Admin/admin_home/index.html.twig',[
         'header'=> $header,
         'headerForm'=> $headerForm->createView(),
         'presentation'=> $presentation,
         'presentationForm'=> $presentationForm->createView(),
         'entreprise'=> $entreprise,
         'entrepriseForm'=> $entrepriseForm->createView()
       ]);
    
   }
// ROUTE POUR LA PAGE PRESENTATION DENTREPRISE

#[Route('/Admin', name: 'app_admin_entreprise')]
public function indexEntreprise(EntityManagerInterface $entityManager, Request $request): Response
{
    // Récupération du service
    $service = $entityManager->getRepository(Service::class)->findOneBy(['id' => 1]);
    $serviceForm = $this->createForm(ServiceType::class, $service);

    // Récupération de l'entreprise
    $entreprise = $entityManager->getRepository(Entreprise::class)->findOneBy(['id' => 2]);
    $entrepriseForm = $this->createForm(EntrepriseType::class, $entreprise);

    // Récupération de l'équipe
    $team = $entityManager->getRepository(Team::class)->findOneBy(['id' => 1]);
    $teamForm = $this->createForm(TeamType::class, $team);

    // Récupération de la marque
    $brand = $entityManager->getRepository(Brand::class)->findOneBy(['id' => 1]);
    $brandForm = $this->createForm(BrandType::class, $brand);

    // Traitement du formulaire de service
    $serviceForm->handleRequest($request);
    if ($serviceForm->isSubmitted() && $serviceForm->isValid()) {
        $file = $serviceForm->get('img')->getData();
        if ($file) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $service->setImg($fileName);
        }
        $entityManager->persist($service);
        $entityManager->flush();
    }

    // Traitement du formulaire d'entreprise
    $entrepriseForm->handleRequest($request);
    if ($entrepriseForm->isSubmitted() && $entrepriseForm->isValid()) {
        $file = $entrepriseForm->get('img')->getData();
        if ($file) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $entreprise->setImg($fileName);
        }
        $entityManager->persist($entreprise);
        $entityManager->flush();
    }

    // Traitement du formulaire d'équipe
    $teamForm->handleRequest($request);
    if ($teamForm->isSubmitted() && $teamForm->isValid()) {
        $file = $teamForm->get('img')->getData();
        if ($file) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $team->setImg($fileName);
        }
        $entityManager->persist($team);
        $entityManager->flush();
    }

    // Traitement du formulaire de marque
    $brandForm->handleRequest($request);
    if ($brandForm->isSubmitted() && $brandForm->isValid()) {
        $file = $brandForm->get('img')->getData();
        if ($file) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $brand->setImg($fileName);
        }
        $entityManager->persist($brand);
        $entityManager->flush();
    }

    // Rendu du template avec les données et les formulaires
    return $this->render('Admin/entreprise.html.twig', [
        'service' => $service,
        'serviceForm' => $serviceForm->createView(),
        'team' => $team,
        'teamForm' => $teamForm->createView(),
        'entreprise' => $entreprise,
        'entrepriseForm' => $entrepriseForm->createView(),
        'brand' => $brand,
        'brandForm' => $brandForm->createView()
    ]);
}

   // ROUTE POUR LA PAGE contact
   #[Route('/admin/contact', name: 'app_admin_contact')]
   public function indexcontact(Request $request, EntityManagerInterface $manager): Response
   {
       $contact = new Contact();
       $contactForm = $this->createForm(ContactType:: class, $contact);

       $contactForm->handleRequest($request);
       if($contactForm->isSubmitted() && $contactForm->isValid){
           $contact = $contactForm->getData();

           $manager->persist($contact);
           $manager->flush();

           $this->addFlash(
               'success',
               'Votre demande a bien été envoyer !'
           );

       }

       return $this->render('Admin/contact.html.twig', [
           // 'form' => $form->createView(),
           'contact'=> $contact,
           'contactForm'=> $contactForm->createView(),
       ]);
   }


// ROUTE POUR LA PAGE FOOTER
#[Route('/admin/footer', name: 'app_admin_footer')]
public function indexFooter(EntityManagerInterface $entityManager, Request $request): Response
{
    $footer = new Footer();
    $footerForm = $this->createForm(FooterType::class, $footer);

    $footerForm->handleRequest($request);
    if ($footerForm->isSubmitted() && $footerForm->isValid()) { 
        $footer = $footerForm->getData();
        $entityManager->persist($footer);
        $entityManager->flush();
    }

    return $this->render('Admin/footer.html.twig', [
        'footer' => $footer,
        'footerForm' => $footerForm->createView(),
    ]);
}

}





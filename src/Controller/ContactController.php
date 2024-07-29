<?php

namespace App\Controller;

use App\Form\FooterType;
use App\Entity\footer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    // #[Route('/admin/contact', name: 'app_admin_contact')]
    // public function index(Request $request, EntityManagerInterface $manager): Response
    // {
    //     $contact = new Contact();
    //     $contactForm = $this->createForm(ContactType:: class, $contact);

    //     $contactForm->handleRequest($request);
    //     if($contactForm->isSubmitted() && $contactForm->isValid){
    //         $contact = $contactForm->getData();

    //         $manager->persist($contact);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             'Votre demande a bien été envoyer !'
    //         );

    //     }

    //     return $this->render('Admin/contact.html.twig', [
    //         // 'form' => $form->createView(),
    //         'contact'=> $contact,
    //         'contactForm'=> $contactForm->createView(),
    //     ]);
    // }
// #[Route('/admin/footer', name: 'app_admin_footer')]
// public function indexFooter(EntityManagerInterface $entityManager, Request $request): Response
// {
//     $footer = new Footer();
//     $footerForm = $this->createForm(FooterType::class, $footer);

//     $footerForm->handleRequest($request);
//     if ($footerForm->isSubmitted() && $footerForm->isValid()) { 
//         $footer = $footerForm->getData();
//         $entityManager->persist($footer);
//         $entityManager->flush();
//     }

//     return $this->render('Admin/footer.html.twig', [
//         'footer' => $footer,
//         'footerForm' => $footerForm->createView(),
//     ]);
// }
}


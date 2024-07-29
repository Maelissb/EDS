<?php
namespace App\Controller\Admin;

use App\Entity\Intervention;
use App\Form\InterventionType;
use App\Entity\Label;
use App\Form\LabelType;
use App\Entity\Depannage;
use App\Form\DepannageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepannageAdminController extends AbstractController
{
    #[Route('/admin/depannage/plomberie{id?}', name: 'app_admin_depannage_plomberie')]
    public function indexPlomberie(EntityManagerInterface $entityManager, Request $request): Response
    {
        return $this->handleDepannage($entityManager, $request, 'Admin/admin_depannage/plomberie.html.twig');
    }

    #[Route('/admin/depannage/chauffage{id?}', name: 'app_admin_depannage_chauffage')]
    public function indexChauffage(EntityManagerInterface $entityManager, Request $request): Response
    {
        return $this->handleDepannage($entityManager, $request, 'Admin/admin_depannage/chauffage.html.twig');
    }

    #[Route('/admin/depannage/pac{id?}', name: 'app_admin_depannage_pac')]
    public function indexPac(EntityManagerInterface $entityManager, Request $request): Response
    {
        return $this->handleDepannage($entityManager, $request, 'Admin/admin_depannage/pac.html.twig');
    }

    #[Route('/admin/depannage/electricite{id?}', name: 'app_admin_depannage_electricite')]
    public function indexElectricite(EntityManagerInterface $entityManager, Request $request): Response
    {
        return $this->handleDepannage($entityManager, $request, 'Admin/admin_depannage/electricite.html.twig');
    }

    private function handleDepannage(EntityManagerInterface $entityManager, Request $request, string $template): Response
    {
        $depannage = $entityManager->getRepository(Depannage::class)->find(1);
        $depannageForm = $this->createForm(DepannageType::class, $depannage);

        $label = $entityManager->getRepository(Label::class)->find(1);
        $labelForm = $this->createForm(LabelType::class, $label);

        $intervention = $entityManager->getRepository(Intervention::class)->find(2);
        $interventionForm = $this->createForm(InterventionType::class, $intervention);

        $depannageForm->handleRequest($request);
        $labelForm->handleRequest($request);
        $interventionForm->handleRequest($request);

        if ($depannageForm->isSubmitted() && $depannageForm->isValid()) {
            $file = $depannageForm->get('img')->getData();
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $depannage->setImg($fileName);
            }
            $entityManager->persist($depannage);
            $entityManager->flush();
        }

        if ($labelForm->isSubmitted() && $labelForm->isValid()) {
            $file = $labelForm->get('img')->getData();
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $label->setImg($fileName);
            }
            $entityManager->persist($label);
            $entityManager->flush();
        }

        if ($interventionForm->isSubmitted() && $interventionForm->isValid()) {
            $entityManager->persist($intervention);
            $entityManager->flush();
        }

        return $this->render($template, [
            'depannage' => $depannage,
            'depannageForm' => $depannageForm->createView(),
            'label' => $label,
            'labelForm' => $labelForm->createView(),
            'intervention' => $intervention,
            'interventionForm' => $interventionForm->createView(),
        ]);
    }
}

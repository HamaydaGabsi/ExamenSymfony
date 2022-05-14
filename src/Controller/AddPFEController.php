<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\PFEType;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AddPFEController extends AbstractController
{
    #[Route('/add/', name: 'app_add_p_f_e')]
    public function index(ManagerRegistry $doctrine, Request $request): Response {
        $entityManager = $doctrine->getManager();

        $pfe = new PFE();
        $form = $this->createForm(PFEType::class, $pfe);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager->persist($pfe);
            $entityManager->flush();
            return $this->render('pfe.info.html.twig',['pfe' => $pfe]);
        } else {
            return $this->render('add_pfe/index.html.twig', [
                'form' => $form->createView()
            ]);
        }

    }
}

<?php

namespace App\Controller;

use App\Entity\Glace;
use App\Form\GlaceForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CreateGlaceController extends AbstractController
{
    #[Route('/create/glace', name: 'app_create_glace')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $glace = new Glace();

        $form = $this->createForm(GlaceForm::class, $glace);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($glace);
                $entityManager->flush();
                $this->addFlash('success', 'Article ajouté avec succès !');
                return $this->redirectToRoute('app_liste_glace');
            }
        return $this->render('create_glace/createglace.html.twig', [
            'Glaceform'=>$form->createView(),
        ]);
    }
}

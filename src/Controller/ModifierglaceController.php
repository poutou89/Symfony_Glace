<?php

namespace App\Controller;

use App\Entity\Glace;
use App\Form\GlaceForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModifierglaceController extends AbstractController
{
    #[Route('/modifierglace/{id}', name: 'app_modifierglace')]
    public function modifier(Glace $glace, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $form = $this->createForm(GlaceForm::class, $glace);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($glace);
            $entityManager->flush();
            $this->addFlash('success', 'Article ajouté avec succès !');
            return $this->redirectToRoute('app_liste_glace');
        }
        return $this->render('modifierglace/modifierglace.html.twig', [
            'Glaceform'=>$form->createView(),
            
    ]);
    }
}